<?php

declare(strict_types = 1);

namespace Assignment;

final class DistanceCalculator
{
    public function calculate(CalculateDistance $command): Distance
    {
        return Distance::sum(
            $command->measure(),
            $command->d1(),
            $command->d2()
        );
    }
}

