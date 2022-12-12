<?php

namespace App\DAO;

use App\DAO\DBHelper;
use App\Models\UserModel;

class UsersDAO extends DBHelper
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
            'password' => password_hash($user->getPassword(), PASSWORD_ARGON2I),
        ]);
    }

    public function getUserByEmail(string $email): ?UserModel
    {
        $statement = $this->pdo->prepare('SELECT id, name, email, password from tb_users where email = :email');
        $statement->bindParam('email', $email);
        $statement->execute();
        $users = $statement->fetchAll(\PDO::FETCH_ASSOC);
       
        if (count($users) > 0) {

            $user = new UserModel();
            $user->setId($users[0]['id']);
            $user->setName($users[0]['name']);
            $user->setEmail($users[0]['email']);
            $user->setPassword($users[0]['password']);               
            return $user;
        }
        return null;
    }

}
