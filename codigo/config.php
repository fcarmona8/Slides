<?php
$config = [
    'db' => [
        'connection' => 'mysql:host=192.168.1.12',
        'dbname' => 'slidescarmonagalindojumelle',
        'usr' => 'root',
        'pwd' => '1234',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]

    ]
];

return $config;