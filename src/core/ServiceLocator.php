<?php
namespace Yframe\Core;

class ServiceLocator
{
    private $services = [];

    public function addService($name, $service) {
        $this->services[$name] = $service;
    }

    public function getService($name) {
        if (!isset($this->services[$name])) {
            throw new Exception("Service not found: " . $name);
        }

        return $this->services[$name];
    }

}