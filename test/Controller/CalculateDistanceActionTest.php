<?php

declare(strict_types = 1);

namespace Assignment\Controller;

use Assignment\DistanceCalculator\CalculateDistance;
use Assignment\DistanceCalculator\Distance;
use Assignment\DistanceCalculator\DistanceCalculator;
use PHPUnit\Framework\TestCase;

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

        $response = $action->__invoke($command);

        self::assertEquals(new Distance('meter', 2.0), $response);
    }
}
