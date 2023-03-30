<?php

namespace Yframe\Core;

use Yframe\Core\Database\Database;

class Application
{
    // 存储配置信息
    private $config;

    // 存储已注册的服务
    private $services = [];

    private $serviceLocator;

    /**
     * Application 构造函数
     *
     * @param array $config 应用程序配置
     */
    public function __construct(array $config)
    {
        $this->config = $config;

        // 初始化服务
        $this->initServices();
    }

    /**
     * 初始化服务
     */
    private function initServices()
    {
        $this->serviceLocator = new ServiceLocator();
        // 在此注册您需要的服务
        $this->serviceLocator->addService('router', new Router());
        $this->serviceLocator->addService('db', Database::getConnection($this->config['database']));
        $this->serviceLocator->addService('cache', new Cache($this->config['cache']['cache_path']));
        $this->serviceLocator->addService('logger', new Logger($this->config['logger']['log_path']));

        $this->initRouter();
    }

    /**
     * 初始化router
     */
    private function initRouter()
    {
        $this->serviceLocator->getService('router')->addRoute('GET', '/users/(\d+)', function ($id) {
            // 调用用户控制器的 show 方法
            $controller = new \App\Controllers\UsersController($this->serviceLocator);
            $controller->show($id);
        });

        $this->serviceLocator->getService('router')->setDefaultHandler(function () {
            // 调用首页控制器的 index 方法
            $controller = new \App\Controllers\HomeController($this->serviceLocator);
            $controller->index();
        });
    }

    /**
     * 运行应用程序
     */
    public function run()
    {
        // 根据请求执行对应的控制器和动作
        $this->serviceLocator->getService('router')->dispatch();
    }

    /**
     * 获取指定服务
     *
     * @param string $name 服务名称
     * @return mixed
     */
    public function getService($name)
    {
        return $this->serviceLocator->getService($name);
    }
}


?>