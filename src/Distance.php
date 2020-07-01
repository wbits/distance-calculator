<?php

declare(strict_types=1);

namespace Assignment;

final class Distance
{
    private $measure;
    private $distance;

    public function __construct(string $measure, float $distance)
    {
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
