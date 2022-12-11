<?php

namespace App\DAO;

use App\DAO\DBHelper;
use App\Models\UserModel;

class UserssDAO extends DBHelper
{
    public function __construct() {
        parent::__construct();
    }
    
    public function insertUser(UserModel $user): void
    {
        $statement = $this->pdo->prepare('INSERT INTO tb_users VALUES(
            null,
            :name,   
            :email,
            :password
        );');
        $statement->execute([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ]);
    }

    public function getUserByEmail(string $email)
    {
        $statement = $this->pdo->prepare('SELECT id, name, email, password from tb_users where email = :email');
        $statement->bindParam('email', $email);
        $statement->execute();
        $users = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return count($users) === 0 ? [] : $users[0];
    }


}
