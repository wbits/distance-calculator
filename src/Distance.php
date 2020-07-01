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

    public static function sum(Distance $d1, Distance $d2, string $measure): float
    {
        if ($d1->measure === 'yard' && $d2->measure == 'meter' && $measure === "meter") {
            $d1->measure = 'meter';
            $d1->distance *= 0.9144;
        }

        $sum = $d1->distance + $d2->distance;
        if ($d1->measure === 'meter' && $d2->measure == 'meter' && $measure === 'yard') {
            $sum *= 1.093613;
        }

        if ($d1->measure === 'yard' && $d2->measure == 'yard' && $measure === "meter") {
            $sum *= 0.9144;
        }

        return $sum;
    }
}

