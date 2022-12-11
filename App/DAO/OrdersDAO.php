<?php

namespace App\DAO;

use App\DAO\DBHelper;
use App\Models\OrderModel;

class OrdersDAO extends DBHelper
{
    public function __construct() {
        parent::__construct();
    }
    
    public function insertOrder(OrderModel $order): void
    {
        $statement = $this->pdo->prepare('INSERT INTO tb_orders VALUES(
            null,
            :building_id,   
            :unit_id,
            :sender,
            :recipient,
            :receiving_date,
            :withdrawn,
            :withdrawal_date,
            :withdrawn_by
        );');
        $statement->execute([
            'building_id' => $order->getBuildingId(),
            'unit_id' => $order->getUnitId(),
            'sender' => $order->getSender(),
            'recipient' => $order->getRecipient(),
            'receiving_date' => $order->getReceivingDate(),
            'withdrawn' => $order->getWithdrawn(),
            'withdrawal_date' => $order->getWithdrawalDate(),
            'withdrawn_by' => $order->getWithdrawnBy()
        ]);
    }

    public function getAllOrders() : array
    {
        $orders = $this->pdo->query("SELECT id, unit_id, sender, recipient, receiving_date FROM tb_orders WHERE building_id = 10 limit 50")->fetchAll(\PDO::FETCH_ASSOC);
        return $orders;
    }

    public function updateOrder()
    {

    }
    public function deleteOrder()
    {

    }

    public function getOrdersByUnit()
    {

    }
}
