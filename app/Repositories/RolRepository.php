<?php

namespace App\Repositories;

use App\Models\Rol;

class RolRepository
{
    public function list()
    {
        $roles = Rol::all();
        return $roles;
    }
}
