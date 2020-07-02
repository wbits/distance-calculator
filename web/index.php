<?php

require '../vendor/autoload.php';

use Assignment\Controller\CalculateDistanceAction;
use Assignment\Controller\CalculatorInvocationStrategy;
use Assignment\Controller\ErrorHandler;
use Assignment\DistanceCalculator\DistanceCalculator;
use Slim\Factory\AppFactory;

$app = AppFactory::create();
$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, false, true);
$errorMiddleware->setDefaultErrorHandler(new ErrorHandler($app));

$controller = new CalculateDistanceAction(
    new DistanceCalculator()
);

$route = $app->post('/calculate/{measure}', $controller);
$route->setInvocationStrategy(new CalculatorInvocationStrategy());

$app->run();
