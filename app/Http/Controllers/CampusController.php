<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CampusRepository;
use Uuid;

class CampusController extends Controller
{
    protected $campus_repository;

    public function __construct(CampusRepository $campus)
    {
        $this->campus_repository = $campus;
    }

    public function create(Request $request)
    {
        $uuid = Uuid::generate()->string;
        $name = $request->input('name');
        $alias = $request->input('alias');
        return response()->json($this->campus_repository->create($uuid, $name, $alias));
    }

    public function update(Request $request, $uuid)
    {
        $name = $request->input('name');
        $alias = $request->input('alias');
        return response()->json($this->campus_repository->update($uuid, $name, $alias));
    }

    public function list()
    {
        return response()->json($this->campus_repository->list());
    }

    public function delete($uuid)
    {
        return response()->json($this->campus_repository->delete($uuid));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return response()->json($this->campus_repository->search($search));
    }

    public function find($uuid)
    {
        return response()->json($this->campus_repository->find($uuid));
    }
}
