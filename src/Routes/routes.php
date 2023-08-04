<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Src\Middlewares\AuthMiddleware; 

use Src\Controllers\{
    AuthController,
    UserController
};


return function (App $app) {


    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write("Welcome to DignuAPI, more information in: github.com/Dignu");
        return $response;
    });
    //Public routes
    $app->group('/v1', function (RouteCollectorProxy $group) {
        $group->get('/', function ($request, $response, array $args) {
            $response->getBody()->write("Welcome to DignuAPI v1, more information in: github.com/Dignu");
            return $response;
        });
        $group->post('/user', UserController::class . ':createUser');
        $group->post('/auth', AuthController::class . ':login');
        $group->post('/refresh-token', AuthController::class . ':refreshToken');
        //    This route be maked in the future
        //    $group->post('/forget-password', AuthController::class . ':forgetPassword');

    });
    //Authenticated routes
    $app->group('/v1', function (RouteCollectorProxy $group) {
        $group->get('/auth', function ($request, $response, array $args) {
            $response->getBody()->write("Welcome to DignuAPI auth, more information in: github.com/Dignu");
            return $response;
        })->add(AuthMiddleware::class);
    
    });
};
