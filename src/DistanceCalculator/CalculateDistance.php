<?php

declare(strict_types = 1);

namespace Assignment\DistanceCalculator;

final class CalculateDistance
{
    private $distances;
    private $measure;

    public function __construct(string $measure, array ...$distances)
    {
        $this->measure = $measure;
        $this->distances = array_map(function (array $distance) {
            return Distance::fromArray($distance);
        }, $distances);
    }

    /**
     * @return Distance[]
     */
    public function distances(): array
    {
        return $this->distances;
    }

    public function measure(): string
    {
        return $this->measure;
    }
}
