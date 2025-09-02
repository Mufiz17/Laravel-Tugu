<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen\Commands\CreateData;
use App\Absen\Queries\GetAllData;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRequest;

class AbsenController extends Controller
{
    protected GetAllData $getAllData;
    protected CreateData $createData;

    public function __construct(
        GetAllData $getAllData,
        CreateData $createData
    ) {
        $this->getAllData = $getAllData;
        $this->createData = $createData;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->getAllData->execute(), 200);
    }

    public function create(CreateRequest $request): JsonResponse
    {
        return response()->json($this->createData->execute($request->validated()), 201);
    }
}
