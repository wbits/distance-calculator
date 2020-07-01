<?php

declare(strict_types = 1);

namespace Assignment;

use PHPUnit\Framework\TestCase;

final class DistanceCalculatorTest extends TestCase
{
    /**
     * @dataProvider provider()
     */
    public function testItCanCalculateTheSumOfTwoDistances(array $d1, array $d2, string $measure, float $expectation)
    {
        $calculator = new DistanceCalculator();

        $sum = $calculator->calculate($d1, $d2, $measure);

        self::assertEquals($expectation, $sum);
    }

    public function provider(): array
    {
        return [
            [
                [
                    'measure' => 'meter',
                    'distance' => 1.0,
                ],
                [
                    'measure' => 'meter',
                    'distance' => 2.0,
                ],
                'meter',
                3.0
            ],
            [
                [
                    'measure' => 'meter',
                    'distance' => .5,
                ],
                [
                    'measure' => 'meter',
                    'distance' => .5,
                ],
                'yard',
                1.093613
            ],
        ];
    }
}

