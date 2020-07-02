<?php

declare(strict_types = 1);

namespace Assignment\Controller;

use Assignment\DistanceCalculator\CalculateDistance;
use Assignment\DistanceCalculator\Error\InvalidMeasure;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpException;
use Slim\Interfaces\InvocationStrategyInterface;

final class CalculatorInvocationStrategy implements InvocationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(
        callable $callable,
        Request $request,
        ResponseInterface $response,
        array $routeArguments
    ): ResponseInterface {
        try {
            $json = $request->getBody()->getContents();
            $data = json_decode($json, true);
            $command = new CalculateDistance($routeArguments['measure'], ...$data['distances']);
        } catch (InvalidMeasure $e) {
            throw new HttpException($request, 'Invalid measure', 422);
        }

        return $callable($command, $request);
    }
}
