<?php

namespace Src\Models;

use DateTime;

class ReservationModel{
    public function __construct(
        private string $id,
        private string $unit,
        private string $responsible,
        private DateTime $dateOfReservation,
        private DateTime $dateReservationMaked,

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

    public function getResponsible(): string
    {
        return $this->responsible;
    }

    public function getDateOfReservation(): DateTime
    {
        return $this->dateOfReservation;
    }

    public function getDateReservationMaked(): DateTime
    {
        return $this->dateReservationMaked;
    }

}