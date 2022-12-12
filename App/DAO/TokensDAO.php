<?php

namespace App\DAO;

use App\Models\TokenModel;

class TokensDAO extends DBHelper
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createToken(TokenModel $token): void
    {
        $statement = $this->pdo
            ->prepare('INSERT INTO tb_tokens
                (
                    token,
                    refresh_token,
                    expired_at,
                    user_id
                )
                VALUES
                (
                    :token,
                    :refresh_token,
                    :expired_at,
                    :user_id
                );
            ');
        $statement->execute([
            'token' => $token->getToken(),
            'refresh_token' => $token->getRefresh_token(),
            'expired_at' => $token->getExpired_at(),
            'user_id' => $token->getUserId()
        ]);
    }

    public function verifyRefreshToken(string $refreshToken): bool
    {
        $statement = $this->pdo
            ->prepare('SELECT
                    id
                FROM tb_tokens
                WHERE refresh_token = :refresh_token;
            ');
        $statement->bindParam('refresh_token', $refreshToken);
        $statement->execute();
        $tokens = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return count($tokens) === 0 ? false : true;
    }
}