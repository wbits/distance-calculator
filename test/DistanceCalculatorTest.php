<?php

declare(strict_types = 1);

namespace Assignment;

use PHPUnit\Framework\TestCase;

final class DistanceCalculatorTest extends TestCase
{
    public function testItCanCalculateTheSumOfTwoDistances()
    {
        $distance1 = $distance2 = [
            'measure' => 'meter',
            'distance' => 1.0,
        ];
        $calculator = new DistanceCalculator();

        $sum = $calculator->calculate($distance1, $distance2, 'meter');

        self::assertEquals(2.0, $sum);
    }
}

