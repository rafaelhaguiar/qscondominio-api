<?php

namespace App\Controllers;

use App\DAO\UsersDAO;
use Slim\Http\Request as Request;
use Slim\Http\Response as Response;
use Firebase\JWT\JWT;
use App\DAO\TokensDAO;
use App\Models\TokenModel;


final class AuthController
{
    public function login(Request $request, Response $response, array $args) : Response
    {

        $data = $request->getParsedBody();
        $email = $data['email'];
        $password = $data['password'];
        $expireDate = $data['expire_date'];

        $userDao = new UsersDAO();
        $user = $userDao->getUserByEmail($email);

        
        if (is_null($user)) {
            return $response->withStatus(401);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $response->withStatus(401);
        }

        $tokenPayload = [
            'sub' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'exp' => (new \DateTime($expireDate))->getTimestamp()
        ];

        $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));
        $refreshTokenPayload = [
            'email' => $user->getEmail(),
            'ramdom' => uniqid()
        ];
        $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));

        $tokenModel = new TokenModel();
        $tokenModel->setExpired_at($expireDate)
            ->setRefresh_token($refreshToken)
            ->setToken($token)
            ->setUserId($user->getId());
        
        $tokensDAO = new TokensDAO();
        $tokensDAO->createToken($tokenModel);

        $response = $response->withJson([
            "token" => $token,
            "refresh_token" => $refreshToken
        ]);

        return $response;
    }


    public function refreshToken(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $refreshToken = $data['refresh_token'];
        $expireDate = $data['expire_date'];

        $refreshTokenDecoded = JWT::decode(
            $refreshToken,
            getenv('JWT_SECRET_KEY'),
            ['HS256']
        );

        $tokensDAO = new TokensDAO();
        $refreshTokenExists = $tokensDAO->verifyRefreshToken($refreshToken);
        if (!$refreshTokenExists) {
            return $response->withStatus(401);
        }
        $userDao = new UsersDAO();
        $user = $userDao->getUserByEmail($refreshTokenDecoded->email);
        if (is_null($user)) {
            return $response->withStatus(401);
        }

        $tokenPayload = [
            'sub' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'expired_at' => $expireDate
        ];

        $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));
        $refreshTokenPayload = [
            'email' => $user->getEmail(),
            'ramdom' => uniqid()
        ];
        $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));

        $tokenModel = new TokenModel();
        $tokenModel->setExpired_at($expireDate)
            ->setRefresh_token($refreshToken)
            ->setToken($token)
            ->setUserId($user->getId());

        $tokensDAO = new TokensDAO();
        $tokensDAO->createToken($tokenModel);

        $response = $response->withJson([
            "token" => $token,
            "refresh_token" => $refreshToken
        ]);

        return $response;
    }
}