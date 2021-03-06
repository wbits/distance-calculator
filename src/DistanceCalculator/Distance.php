<?php

declare(strict_types = 1);

namespace Assignment\DistanceCalculator;

use Assignment\DistanceCalculator\Error\InvalidMeasure;

final class Distance
{
    const MEASURE_IN_YARD = 'yard';
    const MEASURE_IN_METER = 'meter';

    private $measure;
    private $distance;

    private function __construct(string $measure, float $distance)
    {
        if (!self::isMeasureValid($measure)) {
            throw new InvalidMeasure($measure);
        }

        $this->measure = $measure;
        $this->distance = $distance;
    }

    public static function inYards(float $distance): Distance
    {
        return new self(self::MEASURE_IN_YARD, $distance);
    }

    public static function inMeters(float $distance): Distance
    {
        return new self(self::MEASURE_IN_METER, $distance);
    }

    public static function fromArray(array $distance): Distance
    {
        return new self($distance['measure'], $distance['distance']);
    }

    public static function sum(string $measure, Distance ...$distances): Distance
    {
        if (!self::isMeasureValid($measure)) {
            throw new InvalidMeasure($measure);
        }

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

        if (self::MEASURE_IN_METER === $measure) {
            return self::yardToMeter($this->distance);
        }

        if (self::MEASURE_IN_YARD === $measure) {
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

    private static function isMeasureValid(string $measure): bool
    {
        return in_array($measure, [self::MEASURE_IN_METER, self::MEASURE_IN_YARD]);
    }
}
