<?php

// 定义常量，存储框架的根目录
define('BASE_PATH', dirname(__DIR__));

// 引入 Composer 的自动加载器
require_once BASE_PATH . '/vendor/autoload.php';

// 引入应用程序配置文件
$config = require_once BASE_PATH . '/config/app.php';

//数据库配置
$dbConfig = require_once BASE_PATH . '/config/database.php';

// Get database instance with configuration
Y::$db = Yframe\Core\Database::getInstance($dbConfig);

// 实例化框架的主类，并运行应用
$app = new Yframe\Core\Application($config);

$app->run();
