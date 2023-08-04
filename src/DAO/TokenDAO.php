<?php

namespace Src\DAO;

use PDO;
use Src\Models\TokenModel;

class TokenDAO extends DBHelper
{
    public function __construct()
    {
        parent::__construct();
    }

    public function saveOrUpdate(TokenModel $tokenModel): void
    {
        $userEmail = $tokenModel->getUserEmail();
        $accessToken = base64_encode($tokenModel->getAccessToken());
        $refreshToken = base64_encode($tokenModel->getRefreshToken());
        $accessTokenExpiration = $tokenModel->getAccessTokenExpiration()->format('Y-m-d H:i:s');
        $refreshTokenExpiration = $tokenModel->getRefreshTokenExpiration()->format('Y-m-d H:i:s');
    
        $query = "INSERT INTO tab_tokens (user_email, access_token, refresh_token, access_token_expiration, refresh_token_expiration, created_at)
                  VALUES (:user_email, :access_token, :refresh_token, :access_token_expiration, :refresh_token_expiration, NOW())
                  ON DUPLICATE KEY UPDATE 
                  access_token = VALUES(access_token),
                  refresh_token = VALUES(refresh_token),
                  access_token_expiration = VALUES(access_token_expiration),
                  refresh_token_expiration = VALUES(refresh_token_expiration)";
    
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'user_email' => $userEmail,
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'access_token_expiration' => $accessTokenExpiration,
            'refresh_token_expiration' => $refreshTokenExpiration,
        ]);
    }
    
    

    public function checkIfAccessTokenIsValid(string $userEmail, string $accessToken): bool
{
    $token = $this->getTokenByEmail($userEmail);

    if ($token->getAccessToken() != $accessToken) {

        throw new \Exception("Token inválido.");
    }

    if (new \DateTime() > $token->getAccessTokenExpiration()) {
        throw new \Exception("Token expirado.");
    }

    return true;
}

public function checkIfRefreshTokenIsValid(string $userEmail, string $refreshToken): bool
{
    $token = $this->getTokenByEmail($userEmail);

    if ($token->getRefreshToken() !== $refreshToken) {
        throw new \Exception("Refresh token inválido.");
    }

    if (new \DateTime() > $token->getRefreshTokenExpiration()) {
        throw new \Exception("Refresh token inválido.");
    }

    return true;
}

private function getTokenByEmail(string $userEmail): TokenModel
{
    $statement = $this->pdo->prepare('SELECT * FROM tab_tokens WHERE user_email = :user_email');
    $statement->execute(['user_email' => $userEmail]);
    $tokenData = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$tokenData) {
        throw new \Exception("Invalid token.");
    }

    return new TokenModel(
        $tokenData['user_email'],
        base64_decode($tokenData['access_token']),
        base64_decode($tokenData['refresh_token']),
        new \DateTime($tokenData['access_token_expiration']),
        new \DateTime($tokenData['refresh_token_expiration']),
        new \DateTime($tokenData['created_at'])
    );
}

}
