<?php

namespace App\Repositories;

use App\Models\Group;

class GroupRepository
{
    public function find($uuid)
    {
        return Group::where('uuid', '=', $uuid)->first();
    }

    public function search($group)
    {
        return Group::where('name', 'like', '%' . $group . '%')->get();
    }

    public function list()
    {
        return Group::all();
    }
}

