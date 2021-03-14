<?php

namespace App\Repositories;

use App\Models\Campus;

class CampusRepository
{
    public function create($uuid, $name, $alias)
    {
        $new_campus['uuid'] = $uuid;
        $new_campus['name'] = $name;
        $new_campus['alias'] = $alias;
        return Campus::create($new_campus);
    }

    public function update($uuid, $name, $alias)
    {
        $campus = $this->find($uuid);
        $campus->name = $name;
        $campus->alias = $alias;
        $campus->save();
        return $campus;
    }

    public function delete($uuid)
    {
        $campus = $this->find($uuid);
        return $campus->delete();
    }

    public function find($uuid)
    {
        return Campus::where('uuid', '=', $uuid)->first();
    }

    public function search($search)
    {
        return Campus::where('name', 'like', '%' . $search . '%')->get();
    }

    public function list()
    {
        return Campus::all();
    }
}
