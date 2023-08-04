<?php

namespace Src\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Src\DAO\UserDAO;

final class UserController
{
    private UserDAO $userDAO;

    public function __construct(UserDAO $userDAO)
    {
        $this->userDAO = $userDAO;
    }


    public function createUser(Request $request, Response $response, array $args): Response
    {
        $data = json_decode($request->getBody(), true);

        $requiredFields = ['email', 'name', 'password', 'accessType'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                return $response->withStatus(400);
            }
        }

        try {
            $this->userDAO->createUser(
                $data['email'],
                $data['name'],
                $data['password'],
                $data['accessType']
            );
        } catch (\Exception $e) {
            return $response->withStatus(400);
        }

        return $response->withStatus(201);
    }
}
