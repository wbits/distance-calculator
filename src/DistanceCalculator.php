<?php

declare(strict_types = 1);

namespace Assignment;

final class DistanceCalculator
{
    public function calculate(array $distance1, array $distance2, string $string): float
    {
        return $distance1['distance'] + $distance2['distance'];
    }
}

