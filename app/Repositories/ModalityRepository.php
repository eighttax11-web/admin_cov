<?php

namespace App\Repositories;

use App\Models\Modality;
use App\Shared\LogManage;

class ModalityRepository
{
    private $logs;

    public function __construct(LogManage $logManage)
    {
        $this->logs = $logManage;
    }

    public function create($uuid, $name, $alias)
    {
        try {
            $new_modality['uuid'] = $uuid;
            $new_modality['name'] = $name;
            $new_modality['alias'] = $alias;
            $this->logs->info('ModalityRepository','create','Se creo una nueva modalidad');
            return Modality::create($new_modality);
        } catch (\Exception $ex) {
            $this->logs->emergency('ModalityRepository','create','Ocurrio un error al crear una modalidad');
            return response()->json(['error' => $ex->getMessage()]);
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
