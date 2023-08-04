<?php

namespace Src\DAO;

use PDO;

class UserDAO extends DBHelper
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createUser(string $email, string $name, string $password, string $accessType): void
    {
        // Verifica se o usuário já existe no banco
        if ($this->userExists($email)) {
            throw new \Exception("User with this email already exists.");
        }

        // Faz o hash da senha usando o algoritmo padrão do password_hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insere os dados do usuário na tabela usando prepared statement
        $query = "INSERT INTO tab_users (email, name, password, accessType) VALUES (:email, :name, :password, :accessType)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':accessType', $accessType, PDO::PARAM_STR);
        $stmt->execute();
    }

    private function userExists(string $email): bool
    {
        // Verifica se o usuário já existe no banco de dados usando prepared statement
        $query = "SELECT COUNT(*) as count FROM tab_users WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    }
}
