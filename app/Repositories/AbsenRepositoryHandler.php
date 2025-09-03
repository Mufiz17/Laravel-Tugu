<?php

namespace App\Repositories;

use App\Helper\RedisHelper;
use App\Models\Absen;
use Illuminate\Support\Facades\Redis;
use App\Interfaces\Repositories\AbsenRepository;
use Illuminate\Database\Eloquent\Collection;

class AbsenRepositoryHandler implements AbsenRepository
{
    public function getAll(): Collection
    {
        return RedisHelper::redis_cache("absen:all", function () {
            return Absen::get();
        }, 300);
    }

    public function getById(int $id): ?Absen
    {
        return RedisHelper::redis_cache("absen:id:$id", function () use ($id) {
            return Absen::find($id);
        }, 300);
    }

    public function create(array $data): Absen
    {
        RedisHelper::redis_forget(["absen:all"]);
        return Absen::create($data);
    }

    public function update(int $id, array $data): ?Absen
    {
        $cache = $this->getById($id);
        if ($cache) {
            $cache->update($data);
            RedisHelper::redis_forget(["absen:all", "absen:id:{$id}"]);
        }
        return $cache;
    }

    public function delete(int $id): bool
    {
        $cache = $this->getById($id)->delete();
        RedisHelper::redis_forget(["absen:all", "absen:id:{$id}"]);
        return $cache;
    }
}
