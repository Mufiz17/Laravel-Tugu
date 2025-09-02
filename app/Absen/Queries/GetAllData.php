<?php

namespace App\Absen\Queries;

use App\Interfaces\Services\AbsenService;
use Illuminate\Database\Eloquent\Collection;

class GetAllData
{
    public function __construct(
        private AbsenService $service
    ) {}

    public function execute(): Collection
    {
        return $this->service->getAllAbsens();
    }
}