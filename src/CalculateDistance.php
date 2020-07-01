<?php

declare(strict_types = 1);

namespace Assignment;

final class CalculateDistance
{
    private $distance1;
    private $distance2;
    private $measure;

    public function __construct(array $distance1, array $distance2, string $measure)
    {
        $this->distance1 = new Distance($distance1['measure'], $distance1['distance']);
        $this->distance2 = new Distance($distance2['measure'], $distance2['distance']);
        $this->measure = $measure;
    }

    public function d1(): Distance
    {
        return $this->distance1;
    }

    public function d2(): Distance
    {
        return $this->distance2;
    }

    public function measure(): string
    {
        return $this->measure;
    }
}
