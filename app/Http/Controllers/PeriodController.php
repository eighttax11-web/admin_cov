<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PeriodRepository;
use Uuid;

class PeriodController extends Controller
{
    protected $period_repository;

    public function __construct(PeriodRepository $period)
    {
        $this->period_repository = $period;
    }

    public function create(Request $request)
    {
        $uuid = Uuid::generate()->string;
        $name = $request->input('name');
        $alias = $request->input('alias');
        return response()->json($this->period_repository->create($uuid, $name, $alias));
    }

    public function update(Request $request, $uuid)
    {
        $name = $request->input('name');
        $alias = $request->input('alias');
        return response()->json($this->period_repository->update($uuid, $name, $alias));
    }

    public function list()
    {
        return response()->json($this->period_repository->list());
    }

    public function delete($uuid)
    {
        return response()->json($this->period_repository->delete($uuid));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return response()->json($this->period_repository->search($search));
    }

    public function find($uuid)
    {
        return response()->json($this->period_repository->find($uuid));
    }
}
