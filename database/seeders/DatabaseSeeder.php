<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\GroupSeeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(GroupSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
