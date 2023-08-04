<?php

namespace Src\Middlewares;

use Psr\Container\ContainerInterface;
use Tuupola\Middleware\JwtAuthentication;


class JwtAuthenticationFactory
{
    public function __invoke(ContainerInterface $container): JwtAuthentication
    {
        $secretKey = $container->get('jwtSecretKey');

        return new JwtAuthentication([
            "secret" => $secretKey,
            "secure" => false,
            "relaxed" => ["localhost"],
            "attribute" => "decoded_token_data",
            "algorithm" => ["HS256"],
            "error" => function ($response, $arguments) {
                $data = array('ERROR' => 'Unauthorized');
                $response = $response->withHeader("Content-Type", "application/json");
                $response->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
                return $response->withStatus(401);
            }
        ]);
    }
}
