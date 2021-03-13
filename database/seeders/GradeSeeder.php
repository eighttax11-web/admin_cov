<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;
use Uuid;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grade = new Grade();
        $grade->uuid =  Uuid::generate()->string;
        $grade->name = '1';
        $grade->save();

        $grade = new Grade();
        $grade->uuid =  Uuid::generate()->string;
        $grade->name = '2';
        $grade->save();

        $grade = new Grade();
        $grade->uuid =  Uuid::generate()->string;
        $grade->name = '3';
        $grade->save();

        $grade = new Grade();
        $grade->uuid =  Uuid::generate()->string;
        $grade->name = '4';
        $grade->save();

        $grade = new Grade();
        $grade->uuid =  Uuid::generate()->string;
        $grade->name = '5';
        $grade->save();

        $grade = new Grade();
        $grade->uuid =  Uuid::generate()->string;
        $grade->name = '6';
        $grade->save();

        $grade = new Grade();
        $grade->uuid =  Uuid::generate()->string;
        $grade->name = '7';
        $grade->save();

        $grade = new Grade();
        $grade->uuid =  Uuid::generate()->string;
        $grade->name = '8';
        $grade->save();

        $grade = new Grade();
        $grade->uuid =  Uuid::generate()->string;
        $grade->name = '9';
        $grade->save();

        $grade = new Grade();
        $grade->uuid =  Uuid::generate()->string;
        $grade->name = '10';
        $grade->save();

        $grade = new Grade();
        $grade->uuid =  Uuid::generate()->string;
        $grade->name = '11';
        $grade->save();
    }
}
