<?php

declare(strict_types = 1);

namespace Assignment\Controller;

use Assignment\DistanceCalculator\CalculateDistance;
use Assignment\DistanceCalculator\DistanceCalculator;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Message;

final class CalculateDistanceActionTest extends TestCase
{
    public function testItCanCalculateTheSumOfTwoDistances()
    {
        $action = new CalculateDistanceAction(new DistanceCalculator());
        $request = $this->prophesize(ServerRequestInterface::class);

        /** @var Message $response */
        $response = $action($this->getCommand(), $request->reveal());

        self::assertInstanceOf(Message::class, $response);
        self::assertEquals(['application/json'], $response->getHeader('Content-Type'));
        self::assertEquals((string) $response->getBody(), $this->expectedContent());
    }

    private function getCommand(): CalculateDistance
    {
        return new CalculateDistance(
            'meter',
            ['measure' => 'meter', 'distance' => 1.0],
            ['measure' => 'meter', 'distance' => 1.0]
        );
    }

    private function expectedContent(): string
    {
        return json_encode(['measure' => 'meter', 'distance' => 2.0]);
    }
}
