<?php

declare(strict_types = 1);

namespace Assignment\DistanceCalculator\Error;

use Prophecy\Exception\InvalidArgumentException;

final class InvalidMeasure extends InvalidArgumentException
{
    public function __construct(string $illegalMeasure)
    {
        $message = sprintf("Illegal measure given: %s, only 'meter' or 'yard' are allowed", $illegalMeasure);
        parent::__construct($message);
    }
}
