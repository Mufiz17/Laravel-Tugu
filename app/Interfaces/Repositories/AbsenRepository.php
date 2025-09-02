<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface AbsenRepository
{
    public function getAll(): Collection;
}