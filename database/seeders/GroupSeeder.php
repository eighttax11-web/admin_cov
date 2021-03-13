<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;
use Uuid;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'A';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'B';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'C';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'D';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'E';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'F';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'G';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'H';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'I';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'J';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'K';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'L';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'M';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'N';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'Ñ';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'O';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'P';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'Q';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'R';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'S';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'T';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'U';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'V';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'W';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'X';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'Y';
        $group->save();

        $group = new Group();
        $group->uuid =  Uuid::generate()->string;
        $group->name = 'Z';
        $group->save();
    }
}
