<?php

namespace App\Absen\Queries;

use App\Interfaces\Services\AbsenService;
use App\Models\Absen;

class GetDataById
{
    public function __construct(
        private AbsenService $service
    ) {}

    public function execute(int $id): ?Absen    
    {
        return $this->service->getAbsenById($id);
    }
}