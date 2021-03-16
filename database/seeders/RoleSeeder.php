<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use Uuid;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Rol();
        $role->uuid = Uuid::generate()->string;
        $role->role = 'Administrador';
        $role->save();

        $role = new Rol();
        $role->uuid = Uuid::generate()->string;
        $role->role = 'Jefe de Carrera';
        $role->save();

        $role = new Rol();
        $role->uuid = Uuid::generate()->string;
        $role->role = 'Profesor';
        $role->save();

        $role = new Rol();
        $role->uuid = Uuid::generate()->string;
        $role->role = 'Default';
        $role->save();
    }
}
