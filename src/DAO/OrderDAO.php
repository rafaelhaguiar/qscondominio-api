<?php

namespace Src\DAO;

use PDO;
use Src\Models\OrderModel;
use Src\Models\UnitModel;

class OrderDAO extends DBHelper
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createOrder(OrderModel $orderModel): int
    {

        //$query = "INSERT INTO tab_orders(id, name) VALUES (:id, :name)";
        //$stmt = $this->pdo->prepare($query);
        //$stmt->bindValue(':id', $unitModel->getId(), PDO::PARAM_STR);
        //$stmt->bindValue(':name', $unitModel->getName(), PDO::PARAM_STR);
        //$stmt->execute();
        return $this->pdo->lastInsertId();
       
    }

    public function selectOrders(): void
    {

        //$query = "SELECT unitId tab_units_by_user WHERE userId = :userId";
        //$stmt = $this->pdo->prepare($query);
        //$stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
        //$stmt->execute();
    }
}
