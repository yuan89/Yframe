<?php

namespace App\Controllers;

class HomeController
{
    /**
     * 显示首页
     */
    public function index()
    {
        // 在此添加逻辑以生成和显示首页内容

        // 示例：渲染一个视图
        $this->render('home/index');
    }

    /**
     * 渲染视图
     *
     * @param string $view 视图名称
     * @param array $data 视图数据
     */
    protected function render($view, $data = [])
    {
        // 在此添加逻辑以加载和渲染视图文件

        // 示例：加载视图文件
        $viewFile = __DIR__ . "/../views/{$view}.php";
        if (file_exists($viewFile)) {
            // 如果需要，从 $data 数组中提取变量
            extract($data);

            // 加载视图文件
            require $viewFile;
        } else {
            echo "Error: View '{$view}' not found.";
        }
    }
}
