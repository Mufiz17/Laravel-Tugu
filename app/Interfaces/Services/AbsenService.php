<?php

namespace App\Interfaces\Services;

use App\Models\Absen;
use Illuminate\Database\Eloquent\Collection;


interface AbsenService
{
    public function getAllAbsens(): Collection;
    public function createAbsen(array $data): Absen;
    public function getAbsenById(int $id): ?Absen;
    public function UpdateAbsen(int $id, array $data): ?Absen;
    public function deleteAbsen(int $id): bool;
}
