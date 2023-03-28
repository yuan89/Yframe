<?php

namespace Yframe\Core;

class Cache
{
    private $cachePath;

    public function __construct($cachePath)
    {
        $this->cachePath = $cachePath;
    }

    public function set($key, $value, $ttl = 3600)
    {
        $filePath = $this->cachePath . '/' . $key . '.cache';
        $data = serialize([$value, time() + $ttl]);
        return file_put_contents($filePath, $data);
    }

    public function get($key)
    {
        $filePath = $this->cachePath . '/' . $key . '.cache';
        if (!file_exists($filePath)) {
            return null;
        }

        $data = file_get_contents($filePath);
        list($value, $expires) = unserialize($data);

        if (time() > $expires) {
            unlink($filePath);
            return null;
        }

        return $value;
    }
}
