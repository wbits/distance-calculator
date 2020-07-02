<?php

use Assignment\Controller\CalculateDistanceAction;
use Assignment\DistanceCalculator\CalculateDistance;
use Assignment\DistanceCalculator\DistanceCalculator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Psr7\Message;

require '../vendor/autoload.php';

$app = AppFactory::create();
$app->addRoutingMiddleware();

$controller = new CalculateDistanceAction(
    new DistanceCalculator()
);

$app->post(
    '/calculate/{measure}',
    function (Request $request, Response $response, $args) use ($controller): Message {
        $json = $request->getBody()->getContents();
        $data = json_decode($json, true);
        $command = new CalculateDistance($args['measure'], ...$data['distances']);

        return $controller($command);
    }
);

$app->run();
