<?php

declare(strict_types = 1);

namespace Assignment\DistanceCalculator;

use PHPUnit\Framework\TestCase;

final class DistanceCalculatorTest extends TestCase
{
    /**
     * @dataProvider provider()
     */
    public function testItCanCalculateTheSumOfTwoDistances(array $d1, array $d2, string $measure, Distance $expectation)
    {
        $calculator = new DistanceCalculator();
        $command = new CalculateDistance($measure, $d1, $d2);

        $newDistance = $calculator->calculate($command);

        self::assertEquals($expectation, $newDistance);
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
                Distance::inMeters(3.0),
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
                Distance::inYards(1.093613),
            ],
            [
                [
                    'measure' => 'yard',
                    'distance' => .2,
                ],
                [
                    'measure' => 'yard',
                    'distance' => .8,
                ],
                'meter',
                Distance::inMeters(0.9144),
            ],
            [
                [
                    'measure' => 'yard',
                    'distance' => 1,
                ],
                [
                    'measure' => 'meter',
                    'distance' => 1,
                ],
                'meter',
                Distance::inMeters(1.9144),
            ],
        ];
    }
}
