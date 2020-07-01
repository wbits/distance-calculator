<?php

declare(strict_types = 1);

namespace Assignment;

final class DistanceCalculator
{
    public function calculate(array $distance1, array $distance2, string $measure): Distance
    {
        return Distance::sum(
            new Distance($distance1['measure'], $distance1['distance']),
            new Distance($distance2['measure'], $distance2['distance']),
            $measure
        );
    }
}

