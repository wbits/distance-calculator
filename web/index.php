<?php

require '../vendor/autoload.php';

use Assignment\Controller\CalculateDistanceAction;
use Assignment\Controller\CalculatorInvocationStrategy;
use Assignment\DistanceCalculator\DistanceCalculator;
use Slim\Factory\AppFactory;

$app = AppFactory::create();
$app->addRoutingMiddleware();

$controller = new CalculateDistanceAction(
    new DistanceCalculator()
);

$route = $app->post('/calculate/{measure}', $controller);
$route->setInvocationStrategy(new CalculatorInvocationStrategy());

$app->run();
