<?php

namespace Src\Models;

use DateTime;

class TokenModel
{
    public function __construct(
        private string $userEmail,
        private string $accessToken,
        private string $refreshToken,
        private DateTime $accessTokenExpiration,
        private DateTime $refreshTokenExpiration,
        private DateTime $createdAt
    ) {
    }


    public function getUserEmail(): string
    {
        return $this->userEmail;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    public function getAccessTokenExpiration(): DateTime
    {
        return $this->accessTokenExpiration;
    }

    public function getRefreshTokenExpiration(): DateTime
    {
        return $this->refreshTokenExpiration;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
