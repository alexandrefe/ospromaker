<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

$logged = function (Request $request, RequestHandler $handler) {
    $response = $handler->handle($request);
    $existingContent = (string) $response->getBody();

    $responseBody = new Response();
    $responseBody->getBody()->write($existingContent);

    if(!isset($_SESSION['is_logged_in'])) {
        $response = redirect($response, '/');
    }

    return $response;
};
