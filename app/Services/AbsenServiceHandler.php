<?php

namespace App\Services;

use App\Exceptions\NotFound;
use App\Interfaces\Repositories\AbsenRepository;
use App\Interfaces\Services\AbsenService;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class AbsenServiceHandler implements AbsenService
{
    public function __construct(
        private AbsenRepository $repository
    ){}

    public function getAllAbsens(): Collection
    {
        try{
            $data = $this->repository->getAll();
            return $data;
        } catch(Exception)
        {
            throw new NotFound();
        }
    }
}
