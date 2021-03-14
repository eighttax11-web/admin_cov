<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Uuid;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function authenticate(Request $request)
    {
        return $this->user->authenticate($request);
    }

    public function getAuthenticatedUser()
    {
        return $this->user->getAuthenticatedUser();
    }

    public function addUser(Request $request)
    {
        $uuid = Uuid::generate()->string;
        return $this->user->addUser($request, $uuid);
    }

    public function list()
    {
        return $this->user->list();
    }
}

