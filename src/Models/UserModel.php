<?php

namespace Src\Models;


class UserModel
{
    public function __construct(
        private string $email,
        private string $accessType
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAccessType(): string
    {
        return $this->accessType;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setAccessType(string $accessType): void
    {
        $this->accessType = $accessType;
    }

}