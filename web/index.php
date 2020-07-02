<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require '../vendor/autoload.php';

$app = AppFactory::create();
$app->addRoutingMiddleware();

$app->post('/calculate/{measure}', function (Request $request, Response $response, $args) {
    $jsonPayload = ['measure'  => 'meter', 'distance' => 3.0];
    $response->getBody()->write(json_encode($jsonPayload));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
