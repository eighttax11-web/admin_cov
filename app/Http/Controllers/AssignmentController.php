<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AssignmentRepository;
use Uuid;

class AssignmentController extends Controller
{
    protected $assignment_repository;
    public function __construct(AssignmentRepository $assignment)
    {
        $this->assignment_repository = $assignment;
    }

    public function list(): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->assignment_repository->list());
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $uuid = Uuid::generate()->string;
        $person_id = $request->input('person_id');
        $grade_id = $request->input('grade_id');
        $group_id = $request->input('group_id');
        $career_id = $request->input('career_id');
        $modality_id = $request->input('modality_id');
        $campus_id = $request->input('campus_id');
        $period_id = $request->input('period_id');
        $year = strval(date('y'));
        $status = true;
        return response()->json($this->assignment_repository->create($uuid, $person_id, $grade_id, $group_id, $career_id, $modality_id, $campus_id, $period_id, $year, $status));
    }

    public function update(Request $request, $uuid): \Illuminate\Http\JsonResponse
    {
        $person_id = $request->input('person_id');
        $grade_id = $request->input('grade_id');
        $group_id = $request->input('group_id');
        $career_id = $request->input('career_id');
        $modality_id = $request->input('modality_id');
        $campus_id = $request->input('campus_id');
        $period_id = $request->input('period_id');
        $year = $request->input('year');
        $status = $request->input('status');

        return response()->json($this->assignment_repository->update($uuid, $person_id, $grade_id, $group_id, $career_id, $modality_id, $campus_id, $period_id, $year, $status));
    }

    public function find($uuid)
    {
        return response()->json($this->assignment_repository->find($uuid));
    }

    public function delete($uuid)
    {
        return response()->json($this->assignment_repository->delete($uuid));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        return response()->json($this->assignment_repository->search($search));
    }

}
