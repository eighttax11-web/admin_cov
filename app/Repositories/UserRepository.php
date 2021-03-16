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


class UserRepository
{

    public function addUser($request, $uuid)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'second_surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        DB::beginTransaction();

        try {

            $person = Person::create([
                'uuid' => $uuid,
                'name' => $request->get('name'),
                'surname' => $request->get('surname'),
                'second_surname' => $request->get('second_surname')
            ]);

            $user = User::create([
                'uuid' => $uuid,
                'person_id' => $person->id,
                'email' => $request->get('email'),
                'name' => $request->get('name'),
                'password' => Hash::make($request->get('password')),
            ]);

            $user->roles()->attach([4]);

            DB::commit();

        } catch (\Exception | Throwable $e) {

            DB::rollBack();

            throw $e;

        }

        $token = JWTAuth::fromUser($user);

        $user = User::with('person', 'roles')->where('id', $user->id)->get();

        $user->toArray();

        return response()->json(compact('user', 'token'), 201);
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

