<?php

namespace Src\DAO;

use PDO;
use PDOException;

abstract class DBhelper
{
    protected PDO $pdo;

    public function __construct()
    {
        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWORD');
        $port = getenv('DB_PORT');

        $dsn = "mysql:host={$host};dbname={$dbname};port={$port}";

        try {
            $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar com o banco de dados: " . $e->getMessage());
        }
    }
}
