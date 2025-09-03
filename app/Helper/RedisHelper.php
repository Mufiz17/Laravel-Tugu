<?php

namespace App\Helper;

use Illuminate\Support\Facades\Redis;

class RedisHelper
{

    public static function redis_cache(string $key, callable $callback, int $ttl = 300)
    {
        $key = "app:$key"; // prefix key
        $cache = Redis::get($key);

        if ($cache !== null) {
            return unserialize($cache);
        }

        $data = $callback();
        Redis::setex($key, $ttl, serialize($data));
        return $data;
    }

    public static function redis_forget(string|array $keys)
    {
        $keys = (array) $keys;

        foreach ($keys as $key) {
            $key = "app:$key";

            if (str_contains($key, '*')) {
                $allKeys = Redis::keys($key);
                if ($allKeys) {
                    Redis::del($allKeys);
                }
            } else {
                Redis::del($key);
            }
        }
    }
}
