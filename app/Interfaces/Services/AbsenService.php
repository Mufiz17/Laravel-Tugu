<?php

namespace App\Interfaces\Services;

use Illuminate\Database\Eloquent\Collection;


interface AbsenService
{
    public function getAllAbsens(): Collection;
}
