<?php

declare(strict_types=1);

namespace DDDCodeSamples\Warranty;

/**
 * Class LineItem
 *
 * @package Warranty
 */
class LineItem
{
    public float $amount;
    public string $description;

    public function __construct(float $amount, string $description)
    {
        $this->amount = $amount;
        $this->description = $description;
    }

}
