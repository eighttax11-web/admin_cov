<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GradeRepository;
use Uuid;

class GradeController extends Controller
{
    protected $grade_repository;
    public function __construct(GradeRepository $grade)
    {
        $this->grade_repository = $grade;
    }

    public function list()
    {
        return response()->json($this->grade_repository->list());
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return response()->json($this->grade_repository->search($search));
    }

    public function find($uuid)
    {
        return response()->json($this->grade_repository->find($uuid));
    }
}
