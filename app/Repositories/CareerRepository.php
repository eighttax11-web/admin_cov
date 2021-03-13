<?php

namespace App\Repositories;

use App\Models\Career;

class CareerRepository
{
    public function create($uuid, $name, $alias)
    {
        $new_career['uuid'] = $uuid;
        $new_career['name'] = $name;
        $new_career['alias'] = $alias;
        return Career::create($new_career);
    }

    public function update($uuid, $name, $alias)
    {
        $career = $this->find($uuid);
        $career->name = $name;
        $career->alias = $alias;
        $career->save();
        return $career;
    }

    public function delete($uuid)
    {
        $career = $this->find($uuid);
        return $career->delete();
    }

    public function find($uuid)
    {
        return Career::where('uuid', '=', $uuid)->first();
    }

    public function search($career)
    {
        return Career::where('name', 'like', '%' . $career . '%')->get();
    }

    public function list()
    {
        return Career::all();
    }
}
