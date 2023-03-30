<?php
namespace Yframe\Core;

class Container
{
    private $services = [];
    private $instances = [];

    public function set($name, $service)
    {
        $this->services[$name] = $service;
    }

    public function get($name)
    {
        if (!isset($this->services[$name])) {
            throw new \Exception("Service not found: " . $name);
        }

        if (!isset($this->instances[$name])) {
            $this->instances[$name] = $this->build($this->services[$name]);
        }

        return $this->instances[$name];
    }

    private function build($service)
    {
        if (is_callable($service)) {
            return $service($this);
        } elseif (is_string($service) && class_exists($service)) {
            return new $service;
        }

        throw new \Exception("Service could not be built: " . print_r($service, true));
    }
}
