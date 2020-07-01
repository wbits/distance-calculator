<?php

declare(strict_types = 1);

namespace Assignment\Controller;

use Assignment\DistanceCalculator\CalculateDistance;
use Assignment\DistanceCalculator\DistanceCalculator;
use Slim\Psr7\Message;
use Slim\Psr7\Response;

final class CalculateDistanceAction
{
    private $distanceCalculator;

    public function __construct(DistanceCalculator $distanceCalculator)
    {
        $this->distanceCalculator = $distanceCalculator;
    }

    public function __invoke(CalculateDistance $command): Message
    {
        $distance = $this->distanceCalculator->calculate($command);

        $response = new Response();
        $response->getBody()->write(json_encode($distance->toArray()));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
