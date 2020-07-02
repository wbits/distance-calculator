<?php

declare(strict_types = 1);

namespace DistanceCalculator;

use Assignment\DistanceCalculator\Distance;
use Assignment\DistanceCalculator\Error\InvalidMeasure;
use PHPUnit\Framework\TestCase;

final class DistanceTest extends TestCase
{
    public function testItRaisesAnErrorWhenSummingWithIllegalMeasure()
    {
        $invalidMeasure = 'invalid';
        $d1 = Distance::inYards(1.0);
        $d2 = Distance::inYards(2.0);

        $this->expectException(InvalidMeasure::class);

        Distance::sum($invalidMeasure, $d1, $d2);
    }

    public function testItCanSumZeroDistances()
    {
        $expected = Distance::inMeters(0.0);

        $distance = Distance::sum(Distance::MEASURE_IN_METER);

        self::assertEquals($expected, $distance);
    }
}
