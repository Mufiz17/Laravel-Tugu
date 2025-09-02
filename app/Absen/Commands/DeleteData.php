<?php

namespace App\Absen\Commands;

use App\Interfaces\Services\AbsenService;

class DeleteData
{
        public function __construct(
        private AbsenService $service
    ) {}

    public function execute(int $id){
        return $this->service->deleteAbsen($id);
    }
}