<?php

declare(strict_types=1);

namespace DDDCodeSamples\Tests\Warranty;

use DDDCodeSamples\Warranty\Contract;
use PHPUnit\Framework\TestCase;

/**
 * Class TestContractAdmin
 *
 * @package DDDCodeSamples\Tests\Warranty
 */
class TestContractAdmin extends TestCase
{
    /**
     * @test
     */
    public function contractIsSetupCorrectly()
    {
        $contract = new Contract(0, 100.0);
        $this->assertEquals(100.0, $contract->purchasePrice);
        $this->assertEquals(Contract::PENDING, $contract->status);
    }
}
