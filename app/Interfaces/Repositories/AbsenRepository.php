<?php

namespace App\Interfaces\Repositories;

use App\Models\Absen;
use Illuminate\Database\Eloquent\Collection;

interface AbsenRepository
{
    public function getAll(): Collection;
    public function create(array $data): Absen;
}