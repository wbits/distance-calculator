<?php

declare(strict_types = 1);

namespace Assignment;

final class DistanceCalculator
{
    public function calculate(array $distance1, array $distance2, string $measure): float
    {
        $sum = $distance1['distance'] + $distance2['distance'];
        if ($measure === 'yard') {
            $sum = $sum * 1.093613;
        }

        return $sum;
    }
}

