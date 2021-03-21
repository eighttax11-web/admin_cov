<?php

namespace App\Repositories;

use App\Models\Rol;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Facades\DB;
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
                $nameOriginal = $request->file('excel')->getClientOriginalName(); //nombre original
                $ext = $request->file('excel')->getClientOriginalExtension(); // extension
                $user = 1;
                $path = public_path('teachers');
                $nameFile = strval($user) . '_' . strval(date('Y_m_d__H_i_s.')) . $ext;
                $request->file('excel')->move($path, $nameFile);

                $objArchivo = [
                    'uuid' => Uuid::generate()->string,
                    'original_name' => $nameOriginal,
                    'assigned_name' => $nameFile
                ];

//                var_dump($objArchivo);die();

                $archivo = TeacherList::create($objArchivo);

                $libro = \PhpOffice\PhpSpreadsheet\IOFactory::load($path . '/' . $nameFile);
                $hoja = $libro->getActiveSheet();
                $totalFilas = $hoja->getCellCollection()->getHighestRow();
                $teachers = [];

                //nombre	ap_paterno	ap_materno	matricula	equipo
                DB::beginTransaction();
                for ($i = 2; $i <= 6; $i++) {
                    if ($hoja->getCell("A" . $i)->getValue() != null) {

                        $name = $hoja->getCell("A" . $i)->getValue();
                        $surname = $hoja->getCell("B" . $i)->getValue();
                        $second_surname = $hoja->getCell("C" . $i)->getValue();
                        $email = $hoja->getCell("D" . $i)->getValue();

                        $person = Person::create([
                            'uuid' => Uuid::generate()->string,
                            'name' => $name,
                            'surname' => $surname,
                            'second_surname' => $second_surname,
                            'file_id' => $archivo->id
                        ]);

                        $user = User::create([
                            'uuid' => Uuid::generate()->string,
                            'person_id' => $person->id,
                            'email' => $email,
                            'name' => $name,
                            'password' => Hash::make($request->get('password').substr($request->get('name'), 0, 3).substr($request->get('surname'), 0, 3)),
                        ]);

                    } else {
                        break;
                    }
                }
                DB::commit();

                $token = JWTAuth::fromUser($user);

                $user = User::with('person', 'roles')->where('id', $user->id)->get();

                $user->toArray();

                return response()->json(compact('user', 'token'), 201);

            } catch (\Exception $exception) {
                DB::rollBack();
                return response()->json(['error' => $exception->getMessage()]);
            }
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
        return response()->json(compact('token'));
    }

    public function list()
    {
        $users = User::with('person')->get();

        return $users->toArray();
    }
}

