<?php

namespace App\Repositories;

use App\Models\Absen;
use Illuminate\Support\Facades\Redis;
use App\Interfaces\Repositories\AbsenRepository;
use Illuminate\Database\Eloquent\Collection;

class AbsenRepositoryHandler implements AbsenRepository
{
    public function getAll(): Collection
    {
        $cacheKey = 'absen:all';
        $data = Redis::get($cacheKey);
        if ($data !== null) {
            return unserialize($data);
        }
        $data = Absen::get();
        Redis::setex($cacheKey, 300, serialize($data));
        return $data;
    }
}
