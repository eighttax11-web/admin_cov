<?php

namespace App\Repositories;

use App\Models\Rol;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Shared\LogManage;
use App\Models\TeacherList;
use Uuid;


class UserRepository
{
    private $logs;

    public function __construct(LogManage $logManage)
    {
        $this->logs = $logManage;
    }

    public function addUsers($request)
    {
        if ($request->file('excel') != null) {
            try {
                $mime = $request->file('excel')->getMimeType();
                $nameOriginal = $request->file('excel')->getClientOriginalName();
                $ext = $request->file('excel')->getClientOriginalExtension();
                $user = 1;
                $path = public_path('teachers');
                $nameFile = strval($user) . '_' . strval(date('Y_m_d__H_i_s.')) . $ext;
                $request->file('excel')->move($path, $nameFile);

                $objFile = [
                    'uuid' => Uuid::generate()->string,
                    'original_name' => $nameOriginal,
                    'assigned_name' => $nameFile
                ];

                $file = TeacherList::create($objFile);

                $book = \PhpOffice\PhpSpreadsheet\IOFactory::load($path . '/' . $nameFile);
                $sheet = $book->getActiveSheet();
                $totalRows = $sheet->getCellCollection()->getHighestRow();
                $teachers = [];

                DB::beginTransaction();
                for ($i = 2; $i <= 6; $i++) {
                    if ($sheet->getCell("A" . $i)->getValue() != null) {

                        $name = $sheet->getCell("A" . $i)->getValue();
                        $surname = $sheet->getCell("B" . $i)->getValue();
                        $second_surname = $sheet->getCell("C" . $i)->getValue();
                        $email = $sheet->getCell("D" . $i)->getValue();

                        $person = Person::create([
                            'uuid' => Uuid::generate()->string,
                            'name' => $name,
                            'surname' => $surname,
                            'second_surname' => $second_surname,
                            'file_id' => $file->id
                        ]);

                        $password = substr($name, 0, 3) . substr($surname, 0, 3);

                        $user = User::create([
                            'uuid' => Uuid::generate()->string,
                            'person_id' => $person->id,
                            'email' => $email,
                            'name' => $name,
                            'password' => Hash::make($password),
                        ]);

                        $user->roles()->attach([3]);

                    } else {
                        break;
                    }

                    $this->sendEmail($user);
                }

                Log::info('UserRepository - addUsers - A new users list has been uploaded');

                DB::commit();
            } catch (\Exception $exception) {
                Log::emergency("UserRepository - addUsers - " . $exception->getMessage());

                DB::rollBack();

                return response()->json(['error' => $exception->getMessage()]);
            }

            return response()->json('Users correctly registered', 201);
        }
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }

    public function authenticate($request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = JWTAuth::user();

        Log::info('UserRepository - getAuthenticatedUser' . "User logged in " . $user);

        return response()->json(compact('user','token'));
    }

    public function list()
    {
        $users = User::with('person')->get();

        Log::info('UserRepository - list');

        return $users->toArray();
    }

    public function sendEmail($user) {
        $data['subject'] = 'ADMINCOV';

        $data['for'] = $user['email'];

        Mail::send('mail.mail', ['user' => $user], function($msj) use($data){
            $msj->from("20183l301023@utcv.edu.mx", "ADMINCOV");
            $msj->subject($data['subject']);
            $msj->to($data['for']);
        });
    }
}

