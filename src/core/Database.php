<?php

namespace Yframe\Core;

use PDO;
use PDOException;

class Database
{
    private static $instance;

    public static function getInstance(array $config = [])
    {
        if (self::$instance === null) {
            try {
                $dsn = $config['dsn'] ?? '';
                $username = $config['username'] ?? '';
                $password = $config['password'] ?? '';
                $options = $config['options'] ?? [];

                self::$instance = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }

    // 禁止实例化
    private function __construct() {}

    // 禁止克隆
    private function __clone() {}
}
