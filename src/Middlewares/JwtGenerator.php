<?php

namespace Src\Middlewares;

use DateTime;
use Src\Models\TokenModel;

class JwtGenerator
{
    private static string $secretKey = '';

    public static function setSecretKey(string $secretKey): void
    {
        self::$secretKey = $secretKey;
    }

    public static function generateTokenModel(string $userEmail): TokenModel
    {
        $issuedAt = time();
        $accessTokenExpiration = $issuedAt + 7 * 24 * 60 * 60; // 7 dias em segundos
        $refreshTokenExpiration = $issuedAt + 30 * 24 * 60 * 60; // 30 dias em segundos

        $accessTokenPayload = [
            'iat' => $issuedAt,
            'exp' => $accessTokenExpiration,
            'user_email' => $userEmail,
        ];

        $accessToken = self::generateToken($accessTokenPayload);

        $refreshTokenPayload = [
            'iat' => $issuedAt,
            'exp' => $refreshTokenExpiration,
            'user_email' => $userEmail,
        ];

        $refreshToken = self::generateToken($refreshTokenPayload);

        $createdAt = new DateTime();

        return new TokenModel(
            $userEmail,
            $accessToken,
            $refreshToken,
            new DateTime("@$accessTokenExpiration"),
            new DateTime("@$refreshTokenExpiration"),
            $createdAt
        );
    }

    private static function generateToken(array $payload): string
    {
        $header = self::base64UrlEncode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload = self::base64UrlEncode(json_encode($payload));
        $signature = hash_hmac('sha256', "$header.$payload", getenv('JWT_SECRET_KEY'), true);

        return self::base64UrlEncode($header) . '.' . self::base64UrlEncode($payload) . '.' . self::base64UrlEncode($signature);
    }

    private static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}
