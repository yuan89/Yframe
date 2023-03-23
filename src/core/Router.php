<?php

namespace Yframe\Core;

class Router
{
    // 存储路由规则
    private $routes = [];

    /**
     * 添加路由规则
     *
     * @param string $method HTTP 方法
     * @param string $pattern 路由模式
     * @param callable $handler 处理程序
     */
    public function addRoute($method, $pattern, $handler)
    {
        $this->routes[$method][$pattern] = $handler;
    }

    /**
     * 分派请求到对应的处理程序
     */
    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // 移除查询字符串
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        // 删除多余的斜杠
        $uri = rtrim($uri, '/');

        // 查找匹配的路由规则
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $pattern => $handler) {
                if (preg_match('#^' . $pattern . '$#', $uri, $matches)) {
                    // 调用匹配的处理程序
                    array_shift($matches);
                    return call_user_func_array($handler, $matches);
                }
            }
        }

        // 没有找到匹配的路由规则，返回 404
        header("HTTP/1.0 404 Not Found");
        echo '404 Not Found';
    }
}

