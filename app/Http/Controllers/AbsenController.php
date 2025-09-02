<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Absen\Commands\CreateData;
use App\Absen\Commands\DeleteData;
use App\Absen\Commands\UpdateData;
use App\Absen\Queries\GetAllData;
use App\Absen\Queries\GetDataById;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;

class AbsenController extends Controller
{
    protected GetAllData $getAllData;
    protected GetDataById $getDataById;
    protected CreateData $createData;
    protected UpdateData $updateData;
    protected DeleteData $deleteData;

    public function __construct(
        GetAllData $getAllData,
        GetDataById $getDataById,
        CreateData $createData,
        UpdateData $updateData,
        DeleteData $deleteData,
    ) {
        $this->getAllData = $getAllData;
        $this->getDataById = $getDataById;
        $this->createData = $createData;
        $this->deleteData = $deleteData;
        $this->updateData = $updateData;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->getAllData->execute(), 200);
    }

    public function show(Request $request): JsonResponse
    {
        return response()->json($this->getDataById->execute($request->id), 200);
    }

    public function create(CreateRequest $request): JsonResponse
    {
        return response()->json($this->createData->execute($request->validated()), 201);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        return response()->json($this->updateData->execute($request->id, $request->validated()), 201);
    }

    public function delete(Request $request): JsonResponse
    {
        return response()->json($this->deleteData->execute($request->id), 201);
    }
}
