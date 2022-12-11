<?php

namespace App\Controllers;

use App\DAO\UsersDAO;
use Slim\Http\Request as Request;
use Slim\Http\Response as Response;
use Firebase\JWT\JWT;



final class AuthController
{
    public function login(Request $request, Response $response, array $args) : Response
    {

        $data = $request->getParsedBody();
        $email = $data['email'];
        $password = $data['password'];

        $userDao = new UsersDAO();
        $user = $userDao->getUserByEmail($email);

        if (is_null($user) || !password_verify($password, $user->getPassword())) {
            return $response->withStatus(401);
        }
       return $response;

    }
}