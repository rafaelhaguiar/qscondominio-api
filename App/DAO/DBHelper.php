<?php

namespace App\DAO;


abstract class DBHelper
{   
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct()
    {
        $host = getenv('DB_QS_CONDOMINIO_HOST');
        $port = getenv('DB_QS_CONDOMINIO_PORT');
        $dbname = getenv('DB_QS_CONDOMINIO_DBNAME');
        $user = getenv('DB_QS_CONDOMINIO_USER');
        $pass = getenv('DB_QS_CONDOMINIO_PASSWORD');
        $dsn = "mysql:host={$host};dbname={$dbname};port={$port}";
        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );

    }
}