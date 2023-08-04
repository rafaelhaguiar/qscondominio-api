<?php

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Src\Controllers\AuthController;
use Src\Controllers\UserController;
use Src\DAO\AuthDAO;
use Src\DAO\TokenDAO;
use Src\DAO\UserDAO;
use Src\Middlewares\AuthMiddleware;
use Src\Middlewares\JwtGenerator;
use Tuupola\Middleware\JwtAuthentication;


$containerBuilder = new ContainerBuilder();
$container = $containerBuilder->build();

$container->set(UserDAO::class, function () use ($container) {
    return new UserDAO();
});
$container->set(AuthDAO::class, function () use ($container) {
    return new AuthDAO();
});
$container->set(TokenDAO::class, function () use ($container) {
    return new TokenDAO();
});

$container->set(JwtGenerator::class, function () use ($container) {
    return new JwtGenerator();
});

$container->set(UserController::class, function (ContainerInterface $container) {
    $userDAO = $container->get(UserDAO::class);
    return new UserController($userDAO);
});

$container->set(AuthController::class, function (ContainerInterface $container) {
    $authDAO = $container->get(AuthDAO::class);
    $tokenDAO = $container->get(TokenDAO::class);
    $jwtGenerator = $container->get(JwtGenerator::class);

    return new AuthController($authDAO, $tokenDAO, $jwtGenerator);
});

$container->set(AuthMiddleware::class, function (ContainerInterface $container) {
    $tokenDAO = $container->get(TokenDAO::class);
    return new AuthMiddleware($tokenDAO);
});

$container->set('jwt_secret_key', getenv('JWT_SECRET_KEY'));

$container->set(JwtAuthentication::class, function (ContainerInterface $container) {
    return new JwtAuthentication($container->get('jwt_secret_key'));
});


return $container;
