<?php

    namespace App\Models;

    final class OrderModel{

        private $id;
        private $buildingId;
        private $unitId;
        private $sender;
        private $recipient;
        private $receiving_date;
        private $withdrawn;
        private $withdrawal_date;
        private $withdrawn_by;


        public function getId()
        {
                return $this->id;
        }


        public function getBuildingId()
        {
                return $this->buildingId;
        }

 
        public function setBuildingId($buildingId)
        {
                $this->buildingId = $buildingId;

                return $this;
        }

        public function getUnitId()
        {
                return $this->unitId;
        }


        public function setUnitId($unitId)
        {
                $this->unitId = $unitId;

                return $this;
        }


        public function getSender()
        {
                return $this->sender;
        }


        public function setSender($sender)
        {
                $this->sender = $sender;

                return $this;
        }

        public function getRecipient()
        {
                return $this->recipient;
        }


        public function setRecipient($recipient)
        {
                $this->recipient = $recipient;

                return $this;
        }


        public function getReceivingDate()
        {
                return $this->receiving_date;
        }


        public function setReceivingDate($receiving_date)
        {
                $this->receiving_date = $receiving_date;

                return $this;
        }


        public function getWithdrawn()
        {
                return $this->withdrawn;
        }


        public function setWithdrawn($withdrawn)
        {
                $this->withdrawn = $withdrawn;

                return $this;
        }


        public function getWithdrawalDate()
        {
                return $this->withdrawal_date;
        }

        public function setWithdrawalDate($withdrawal_date)
        {
                $this->withdrawal_date = $withdrawal_date;

                return $this;
        }


        public function getWithdrawnBy()
        {
                return $this->withdrawn_by;
        }

        public function setWithdrawnBy($withdrawn_by)
        {
                $this->withdrawn_by = $withdrawn_by;

                return $this;
        }

 
   

    }