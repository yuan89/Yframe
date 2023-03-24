<?php

class Y
{
    public static $app;

    private static $services = [];

    public static function set($name, $service)
    {
        self::$services[$name] = $service;
    }

    public static function get($name)
    {
        if (!isset(self::$services[$name])) {
            throw new \Exception("Service '{$name}' not found.");
        }

        return self::$services[$name];
    }

    public static function has($name)
    {
        return isset(self::$services[$name]);
    }
}
