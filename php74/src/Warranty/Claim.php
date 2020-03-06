<?php

declare(strict_types=1);

namespace DDDCodeSamples\Warranty;

use DateTime;

/**
 * Class Claim
 *
 * @package Warranty
 */
class Claim
{
    public int $id;
    public float $amount;
    public DateTime $date;
    /** @var RepairPO[] */
    public array $repairPO;

    public function __construct(int $id, float $amount, DateTime $date)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->date = $date;
    }
}
