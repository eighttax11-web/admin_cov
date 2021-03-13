<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GroupRepository;

class GroupController extends Controller
{
    protected $group_repository;
    public function __construct(GroupRepository $group)
    {
        $this->group_repository = $group;
    }

    public function list()
    {
        return response()->json($this->group_repository->list());
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return response()->json($this->group_repository->search($search));
    }

    public function find($uuid)
    {
        return response()->json($this->group_repository->find($uuid));
    }
}
