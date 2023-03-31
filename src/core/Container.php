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
        $reflector = new \ReflectionClass($service);

        // 构造函数注入
        if ($constructor = $reflector->getConstructor()) {
            $constructorParams = $constructor->getParameters();
            $dependencies = $this->resolveDependencies($constructorParams);
            $instance = $reflector->newInstanceArgs($dependencies);
        } else {
            $instance = $reflector->newInstance();
        }

        // 属性注入
        foreach ($reflector->getProperties() as $property) {
            if ($property->isPublic() && $this->hasService($property->getName())) {
                $property->setValue($instance, $this->get($property->getName()));
            }
        }

        return $instance;
    }

    private function hasService($name)
    {
        return isset($this->services[$name]);
    }

    private function resolveDependencies($parameters)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if ($dependency === null) {
                throw new \Exception("Unable to resolve dependency: " . $parameter->getName());
            }

            $dependencies[] = $this->get($dependency->getName());
        }

        return $dependencies;
    }
}
