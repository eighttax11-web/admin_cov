<?php

namespace App\Repositories;

use App\Models\Period;

class PeriodRepository
{
    public function create($uuid, $name, $alias)
    {
        try {
            $new_period['uuid'] = $uuid;
            $new_period['name'] = $name;
            $new_period['alias'] = $alias;
            return Period::create($new_period);
        } catch (\Exception $ex) {
            return "Error";
        }

    }

    public function update($uuid, $name, $alias)
    {
        $period = $this->find($uuid);
        $period->name = $name;
        $period->alias = $alias;
        $period->save();
        return $period;
    }

    public function delete($uuid)
    {
        $period = $this->find($uuid);
        return $period->delete();
    }

    public function find($uuid)
    {
        return Period::where('uuid', '=', $uuid)->first();
    }

    public function search($search)
    {
        return Period::where('name', 'like', '%' . $search . '%')->get();
    }

    public function list()
    {
        return Period::all();
    }
}
