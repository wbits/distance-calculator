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
}
