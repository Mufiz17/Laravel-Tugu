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
        $cache = Redis::get($cacheKey);
        if ($cache !== null) {
            return unserialize($cache);
        }
        $cache = Absen::get();
        Redis::setex($cacheKey, 300, serialize($cache));
        return $cache;
    }

    public function getById(int $id): ?Absen
    {
        $cacheKey = 'absen:id';
        $cache = Redis::get($cacheKey);

        if ($cache !== null) {
            return unserialize($cache);
        }

        $cache = Absen::find($id);
        Redis::setex($cacheKey, 300, serialize($cache));
        return $cache;
    }

    public function create(array $data): Absen
    {
        Redis::del(['absen:all', 'absen:id']);
        return Absen::create($data);
    }

    public function update(int $id, array $data): ?Absen
    {
        $cache = $this->getById($id);
        if ($cache){
            $cache->update($data);
            Redis::del(['absen:all', 'absen:id']);
        }
        return $cache;
    }

    public function delete(int $id): bool
    {
        $cache = $this->getById($id)->delete();
        Redis::del(['absen:all', 'absen:id']);
        return $cache;
    }
}
