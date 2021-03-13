<?php

namespace App\Repositories;

use App\Models\Grade;

class GradeRepository
{
    public function find($uuid)
    {
        return Grade::where('uuid', '=', $uuid)->first();
    }

    public function search($grade)
    {
        return Grade::where('name', 'like', '%' . $grade . '%')->get();
    }

    public function list()
    {
        return Grade::all();
    }
}
