<?php

namespace App\Repositories;

use App\Models\Modality;

class ModalityRepository
{
    public function create($uuid, $name, $alias)
    {
        try {
            $new_modality['uuid'] = $uuid;
            $new_modality['name'] = $name;
            $new_modality['alias'] = $alias;
            return Modality::create($new_modality);
        } catch (\Exception $ex) {
            return "Error";
        }
    }

    public function update($uuid, $name, $alias)
    {
        $modality = $this->find($uuid);
        $modality->name = $name;
        $modality->alias = $alias;
        $modality->save();
        return $modality;
    }

    public function delete($uuid)
    {
        $modality = $this->find($uuid);
        return $modality->delete();
    }

    public function find($uuid)
    {
        return Modality::where('uuid', '=', $uuid)->first();
    }

    public function search($search)
    {
        return Modality::where('name', 'like', '%' . $search . '%')->get();
    }

    public function list()
    {
        return Modality::all();
    }
}
