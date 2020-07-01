<?php

declare(strict_types = 1);

namespace Assignment\Controller;

use Assignment\DistanceCalculator\CalculateDistance;
use Assignment\DistanceCalculator\Distance;
use Assignment\DistanceCalculator\DistanceCalculator;

final class CalculateDistanceAction
{
    private $distanceCalculator;

    public function __construct(DistanceCalculator $distanceCalculator)
    {
        $this->distanceCalculator = $distanceCalculator;
    }

    public function __invoke(CalculateDistance $command): Distance
    {
        return $this->distanceCalculator->calculate($command);
    }
}
