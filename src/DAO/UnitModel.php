<?php

namespace Src\DAO;

use PDO;
use Src\Models\UnitModel;

class UnitDAO extends DBHelper
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createUnit(UnitModel $unitModel): void
    {

        $query = "INSERT INTO tab_units(id, name) VALUES (:id, :name)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $unitModel->getId(), PDO::PARAM_STR);
        $stmt->bindValue(':name', $unitModel->getName(), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function selectUnits(int $userId): void
    {

        $query = "SELECT * tab_units WHERE";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $unitModel->getId(), PDO::PARAM_STR);
        $stmt->bindValue(':name', $unitModel->getName(), PDO::PARAM_STR);
        $stmt->execute();
    }
}
