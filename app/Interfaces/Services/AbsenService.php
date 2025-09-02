<?php

namespace App\Interfaces\Services;

use App\Models\Absen;
use Illuminate\Database\Eloquent\Collection;


interface AbsenService
{
    public function getAllAbsens(): Collection;
    public function createAbsen(array $data): Absen;
}
