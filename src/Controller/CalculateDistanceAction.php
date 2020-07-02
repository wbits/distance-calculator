<?php

declare(strict_types = 1);

namespace Assignment\Controller;

use Assignment\DistanceCalculator\CalculateDistance;
use Assignment\DistanceCalculator\DistanceCalculator;
use Assignment\DistanceCalculator\Error\InvalidMeasure;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpException;
use Slim\Psr7\Message;
use Slim\Psr7\Response;

final class CalculateDistanceAction
{
    private $distanceCalculator;

    public function __construct(DistanceCalculator $distanceCalculator)
    {
        $this->distanceCalculator = $distanceCalculator;
    }

    /**
     * @throws HttpException
     */
    public function __invoke(CalculateDistance $command, ServerRequestInterface $request): Message
    {
        try {
            $distance = $this->distanceCalculator->calculate($command);
            $response = new Response();
            $response->getBody()->write(json_encode($distance->toArray()));

            return $response->withHeader('Content-Type', 'application/json');
        } catch (InvalidMeasure $e) {
            throw new HttpException($request, 'Invalid measure', 422);
        } catch (\Throwable $e) {
            throw new HttpException($request, $e->getMessage(), 500);
        }
    }
}
