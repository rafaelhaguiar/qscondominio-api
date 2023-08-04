<?php

namespace Src\DAO;
use PDO;

use Src\DAO\DBHelper;
use Src\Models\UserModel;

class AuthDAO extends DBHelper
{
    public function __construct()
    {
        parent::__construct();
    }

    public function auth(string $email, string $password): UserModel
    {
        // Busca o usuário pelo email no banco de dados
        $statement = $this->pdo->prepare('SELECT * FROM tab_users WHERE email = :email;');
        $statement->execute(['email' => $email]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        // Verifica se encontrou algum usuário com o email informado
        if (empty($user)) {
            throw new \Exception("Invalid email or password.");
        }

        // Verifica se a senha está correta para o primeiro usuário encontrado
        if (!password_verify($password, $user['password'])) {
            throw new \Exception("Invalid email or password.");
        }

        // Retorna um UserModel populado com os dados do usuário encontrado
        return new UserModel($user['email'], $user['accessType']);
    }
}
