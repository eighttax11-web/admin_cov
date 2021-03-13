<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ModalityRepository;
use Uuid;

class ModalityController extends Controller
{
    protected $modality_repository;

    public function __construct(ModalityRepository $modality)
    {
        $this->modality_repository = $modality;
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $uuid = Uuid::generate()->string;
        $name = $request->input('name');
        $alias = $request->input('alias');
        return response()->json($this->modality_repository->create($uuid, $name, $alias));
    }

    public function update(Request $request, $uuid): \Illuminate\Http\JsonResponse
    {
        $name = $request->input('name');
        $alias = $request->input('alias');
        return response()->json($this->modality_repository->update($uuid, $name, $alias));
    }

    public function list(): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->modality_repository->list());
    }

    public function delete($uuid): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->modality_repository->delete($uuid));
    }

    public function search(Request $request): \Illuminate\Http\JsonResponse
    {
        $search = $request->input('search');
        return response()->json($this->modality_repository->search($search));
    }

    public function find($uuid): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->modality_repository->find($uuid));
    }
}
