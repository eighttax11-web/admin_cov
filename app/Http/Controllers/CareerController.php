<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CareerRepository;
use Uuid;

class CareerController extends Controller
{
    protected $career_repository;

    public function __construct(CareerRepository $career)
    {
        $this->career_repository = $career;
    }

    public function create(Request $request)
    {
        $uuid = Uuid::generate()->string;
        $name = $request->input('name');
        $alias = $request->input('alias');
        return response()->json($this->career_repository->create($uuid, $name, $alias));
    }

    public function update(Request $request, $uuid)
    {
        $name = $request->input('name');
        $alias = $request->input('alias');
        return response()->json($this->career_repository->update($uuid, $name, $alias));
    }

    public function list()
    {
        return response()->json($this->career_repository->list());
    }

    public function delete($uuid)
    {
        return response()->json($this->career_repository->delete($uuid));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return response()->json($this->career_repository->search($search));
    }

    public function find($uuid)
    {
        return response()->json($this->career_repository->find($uuid));
    }
}
