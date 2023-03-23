<?php

namespace App\Models;

abstract class BaseModel
{
    protected $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function all()
    {
        return $this->data;
    }
}
