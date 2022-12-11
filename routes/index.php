<?php

use App\Controllers\AuthController;
use App\Controllers\OrdersController;

use function src\slimConfig;

$app = new \Slim\App(slimConfig());

$app->post('/login', AuthController::class . ':login');

$app->group('', function () use ($app) {
    $app->post('/order', OrdersController::class . ':insertOrder');
    $app->get('/orders', OrdersController::class . ':getAllOrders');
    $app->put('/order', OrdersController::class . ':updateOrder');
    $app->delete('/order', OrdersController::class . ':deleteOrder');
    $app->get('/orders-by-unit', OrdersController::class . ':getOrdersByUnit');
});


$app->run();
