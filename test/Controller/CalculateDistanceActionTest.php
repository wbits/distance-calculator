<?php

declare(strict_types = 1);

namespace Assignment\Controller;

use Assignment\DistanceCalculator\CalculateDistance;
use Assignment\DistanceCalculator\DistanceCalculator;
use PHPUnit\Framework\TestCase;
use Slim\Psr7\Message;

final class CalculateDistanceActionTest extends TestCase
{
    public function testItCanCalculateTheSumOfTwoDistances()
    {
        $action = new CalculateDistanceAction(
            new DistanceCalculator()
        );
        $command = new CalculateDistance(
            'meter',
            ['measure' => 'meter', 'distance' => 1.0],
            ['measure' => 'meter', 'distance' => 1.0]
        );

        /** @var Message $response */
        $response = $action->__invoke($command);
        $expectedContent = json_encode(['measure' => 'meter', 'distance' => 2.0]);

        self::assertInstanceOf(Message::class, $response);
        self::assertEquals(['application/json'], $response->getHeader('Content-Type'));
        self::assertEquals((string) $response->getBody(), $expectedContent);
    }
}
