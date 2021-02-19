<?php

return [
    'database' => [
        'host' => 'mysql:host=127.0.0.1',
        'dbname' => 'nfq_tomas_mikus',
        'username' => 'root',
        'password' => 'password',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
