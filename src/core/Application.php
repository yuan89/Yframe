<?php

namespace Yframe\Core;

class Application
{
    // 存储配置信息
    private $config;

    // 存储已注册的服务
    private $services = [];

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
        // 在此注册您需要的服务
        $this->services['router'] = new Router();

        // 添加路由规则
        $this->services['router']->addRoute('GET', '/', function () {
            // 调用首页控制器的 index 方法
            $controller = new \Yframe\Controllers\HomeController();
            $controller->index();
        });

        $this->services['router']->addRoute('GET', '/users/(\d+)', function ($id) {
            // 调用用户控制器的 show 方法
            $controller = new \Yframe\Controllers\UsersController();
            $controller->show($id);
        });
    }

    /**
     * 运行应用程序
     */
    public function run()
    {
        // 根据请求执行对应的控制器和动作
        $this->services['router']->dispatch();
    }

    /**
     * 获取指定服务
     *
     * @param string $name 服务名称
     * @return mixed
     */
    public function getService($name)
    {
        return $this->services[$name] ?? null;
    }
}


?>