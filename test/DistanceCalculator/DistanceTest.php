<?php

declare(strict_types = 1);

namespace DistanceCalculator;

use Assignment\DistanceCalculator\Distance;
use Assignment\DistanceCalculator\Error\InvalidMeasure;
use PHPUnit\Framework\TestCase;

final class DistanceTest extends TestCase
{
    public function testItRaisesAnErrorWhenCreatedWithIllegalMeasure()
    {
        $invalidMeasure = 'invalid';

        $this->expectException(InvalidMeasure::class);

        new Distance($invalidMeasure, 1.0);
    }

    public function testItRaisesAnErrorWhenSummingWithIllegalMeasure()
    {
        $invalidMeasure = 'invalid';
        $d1 = new Distance('yard', 1.0);
        $d2 = new Distance('yard', 2.0);

        $this->expectException(InvalidMeasure::class);

        Distance::sum($invalidMeasure, $d1, $d2);
    }

    public function testItCanSumZeroDistances()
    {
        $expected = new Distance(Distance::MEASURE_IN_METER, 0.0);

        $distance = Distance::sum(Distance::MEASURE_IN_METER);

        self::assertEquals($expected, $distance);
    }
}
