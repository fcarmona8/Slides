<?php
$config = [
    'db' => [
        //'connection' => 'mysql:host=192.168.1.12',
        'connection' => 'mysql:host=localhost:3306',
        'dbname' => 'slides',
        'usr' => 'root',
        'pwd' => 1234,
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]

    ]
];

return $config;