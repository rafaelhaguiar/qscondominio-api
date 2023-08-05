<?php

namespace Src\Models;

use DateTime;

class OrderModel{
    public function __construct(
        private string $id,
        private string $unit,
        private string $recipient,
        private DateTime $dateArrived,
        private DateTime $dateWithdrawn,
        private string $responsibleForWithdrawal,

    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function getDateArrived(): DateTime
    {
        return $this->dateArrived;
    }

    public function getDateWithdrawn(): DateTime
    {
        return $this->dateWithdrawn;
    }
    public function getResponsibleForWithdrawal(): string
    {
        return $this->responsibleForWithdrawal;
    }
}