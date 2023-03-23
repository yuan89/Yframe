<?php


return [
    'dsn' => 'mysql:host=localhost;dbname=my_database;charset=utf8mb4',
    'username' => 'my_username',
    'password' => 'my_password',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];


