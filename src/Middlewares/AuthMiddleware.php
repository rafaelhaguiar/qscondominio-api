<?php

namespace Src\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

use Psr\Http\Message\ResponseInterface as Response;
use Src\DAO\TokenDAO;

final class AuthMiddleware
{
    private TokenDAO $tokenDAO;

    public function __construct(TokenDAO $tokenDAO)
    {
        $this->tokenDAO = $tokenDAO;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $authorizationHeader = $request->getHeaderLine('Authorization');

        $emailHeader = $request->getHeaderLine('email');

        if (empty($authorizationHeader) || !preg_match('/Bearer\s+(.*)$/i', $authorizationHeader, $matches)) {
            throw new \Exception("Invalid authorization header.");
        }

        $accessToken = $matches[1];

        try {
            $this->tokenDAO->checkIfAccessTokenIsValid($emailHeader, $accessToken);
        } catch (\Exception $e) {
            $response = new \Slim\Psr7\Response();
            $response->getBody()->write(json_encode(["error" => $e->getMessage()]));
            return $response->withStatus(401)
                            ->withHeader('Content-Type', 'application/json');
        }
        return $handler->handle($request);
    }
}
