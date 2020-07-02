<?php

declare(strict_types = 1);

namespace Assignment\DistanceCalculator;

use Assignment\DistanceCalculator\Error\InvalidMeasure;

final class Distance
{
    private $measure;
    private $distance;

    public function __construct(string $measure, float $distance)
    {
        if ($measure !== 'meter' && $measure !== 'yard') {
            throw new InvalidMeasure($measure);
        }

        $this->measure = $measure;
        $this->distance = $distance;
    }

    public static function sum(string $measure, Distance ...$distances): Distance
    {
        $totalDistance = (float) 0.0;
        foreach ($distances as $distance) {
            $totalDistance += $distance->convertTo($measure);
        }

        return new self($measure, $totalDistance);
    }

    public function toArray(): array
    {
        return [
            'measure' => $this->measure,
            'distance' => $this->distance,
        ];
    }

    private function convertTo(string $measure): float
    {
        if ($measure === $this->measure) {
            return $this->distance;
        }

        if ($measure === 'meter') { // this measure has to be yard
            return self::yardToMeter($this->distance);
        }

        if ($measure === 'yard') { // this measure is meter
            return self::meterToYard($this->distance);
        }
    }

    private static function yardToMeter(float $yards): float
    {
        return $yards * .9144;
    }

    private static function meterToYard(float $meter): float
    {
        return $meter * 1.093613;
    }
}

