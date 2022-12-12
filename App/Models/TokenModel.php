<?php

namespace App\Models;

final class TokenModel
{

    private $id;

    private $token;

    private $refresh_token;

    private $expired_at;

    private $user_id;


    public function getId(): int
    {
        return $this->id;
    }


    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }


    public function getToken(): string
    {
        return $this->token;
    }

 
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

 
    public function getRefresh_token(): string
    {
        return $this->refresh_token;
    }


    public function setRefresh_token(string $refresh_token): self
    {
        $this->refresh_token = $refresh_token;
        return $this;
    }


    public function getExpired_at(): string
    {
        return $this->expired_at;
    }


    public function setExpired_at(string $expired_at): self
    {
        $this->expired_at = $expired_at;
        return $this;
    }

 
    public function getUserId(): int
    {
        return $this->user_id;
    }


    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }
}