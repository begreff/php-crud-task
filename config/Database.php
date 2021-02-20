<?php

namespace config;

class Database {
    private \PDO $pdo;

    public function __construct($config) {
        {
            try {
                $this->pdo = new \PDO(
                    $config['host'].';dbname='.$config['dbname'],
                    $config['username'],
                    $config['password'],
                    $config['options']
                );
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }

}
