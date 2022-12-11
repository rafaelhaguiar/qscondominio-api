<?php

namespace App\Controllers;

use App\DAO\OrdersDAO;
use App\Models\OrderModel;
use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

final class OrdersController{

    public function insertOrder(Request $request, Response $response, array $args) : Response
    {

        $ordersDAO = new OrdersDAO();
        $order = new OrderModel();

        $data = $request->getParsedBody();
        $order->setBuildingId($data['buildingId']);
        $order->setUnitId($data['unitId']);
        $order->setSender($data['sender']);
        $order->setRecipient($data['recipient']);
        $order->setReceivingDate($data['receivingDate']);
        $order->setWithdrawn($data['withdrawn']);
        $order->setWithdrawalDate($data['withdrawalDate']);
        $order->setWithdrawnBy($data['withdrawnBy']);

        $ordersDAO->insertOrder($order);
        $response =  $response->withJson([
            'message' => 'Cadastro realizado com sucesso'
        ]);
        return $response;
    }

    public function getAllOrders(Request $request, Response $response, array $args) : Response
    {

        $ordersDAO = new OrdersDAO();
        $orders = $ordersDAO->getAllOrders();
        $response = $response->withJson($orders);

        return $response;
    }
    public function updateOrder(Request $request, Response $response, array $args) : Response
    {

        $response =  $response->withJson([
            "resposta" => "HelloWord"
        ]);
        return $response;
    }
    public function deleteOrder(Request $request, Response $response, array $args) : Response
    {

        $response =  $response->withJson([
            "resposta" => "HelloWord"
        ]);
        return $response;
    }

    public function getOrdersByUnit(Request $request, Response $response, array $args) : Response
    {

        return $response;
    }
}