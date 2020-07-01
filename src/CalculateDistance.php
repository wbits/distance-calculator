<?php

declare(strict_types = 1);

namespace Assignment;

final class CalculateDistance
{
    private $distances;
    private $measure;

    public function __construct(string $measure, array ...$distances)
    {
        $this->distances = array_map(function (array $distance) {
            return new Distance($distance['measure'], $distance['distance']);
        }, $distances);
        $this->measure = $measure;
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
