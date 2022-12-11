<?php

namespace App\Controllers;

use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

final class AuthController
{
    public function login(Request $request, Response $response, array $args) : Response
    {

        $data = $request->getParsedBody();

        return $response;

    }
}