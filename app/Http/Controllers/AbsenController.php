<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Absen\Queries\GetAllData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    protected GetAllData $getAllData;

    public function __construct(
        GetAllData $getAllData
    ) {
        $this->getAllData = $getAllData;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->getAllData->execute(), 200);
    }
}
