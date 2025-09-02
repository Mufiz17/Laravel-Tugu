<?php

namespace App\Services;

use Exception;
use App\Models\Absen;
use App\Exceptions\NotFound;
use App\Interfaces\Services\AbsenService;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\Repositories\AbsenRepository;

class AbsenServiceHandler implements AbsenService
{
    public function __construct(
        private AbsenRepository $repository
    ) {}

    public function getAllAbsens(): Collection
    {
        try {
            $data = $this->repository->getAll();
            return $data;
        } catch (Exception) {
            throw new NotFound();
        }
    }

    public function createAbsen(array $data): Absen
    {
        return $this->repository->create($data);
    }
}
