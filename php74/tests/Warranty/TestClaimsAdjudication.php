<?php

declare(strict_types=1);

namespace DDDCodeSamples\Tests\Warranty;

use DateTime;
use DDDCodeSamples\Warranty\Claim;
use DDDCodeSamples\Warranty\ClaimsAdjustableService;
use DDDCodeSamples\Warranty\Contract;
use PHPUnit\Framework\TestCase;

/**
 * Class TestClaimsAdjudication
 *
 * @package Warranty
 */
class TestClaimsAdjudication extends TestCase
{
    /**
     * @test
     */
    public function claimsAdjudication(): void
    {
        $contract = new Contract(999, 100.0);
        $contract->effectiveDate = DateTime::createFromFormat('m-d-Y', '08-05-2010');
        $contract->expirationDate = DateTime::createFromFormat('m-d-Y', '08-05-2012');
        $contract->status = Contract::ACTIVE;

        $claim = new Claim(888, 79.0, DateTime::createFromFormat('m-d-Y', '08-05-2010'));

        $adjudicator = new ClaimsAdjustableService();
        $adjudicator->adjudicate($contract, $claim);

        $this->assertCount(1, $contract->getClaims());
    }

    /**
     * @test
     */
    public function claimsAdjudicationForInvalidClaim()
    {
        $contract = new Contract(999, 100.0);
        $contract->effectiveDate = DateTime::createFromFormat('m-d-Y', '08-05-2010');
        $contract->expirationDate = DateTime::createFromFormat('m-d-Y', '08-05-2012');
        $contract->status = Contract::ACTIVE;

        $claim = new Claim(888, 81.0, DateTime::createFromFormat('m-d-Y', '08-05-2010'));

        $adjudicator = new ClaimsAdjustableService();
        $adjudicator->adjudicate($contract, $claim);

        $this->assertCount(0, $contract->getClaims());
    }

    /**
     * @test
     */
    public function claimsAdjudicationForPendingContract()
    {
        $pendingContract = new Contract(999, 100.0);
        $pendingContract->effectiveDate = DateTime::createFromFormat('m-d-Y', '08-05-2010');
        $pendingContract->expirationDate = DateTime::createFromFormat('m-d-Y', '08-05-2012');
        $pendingContract->status = Contract::PENDING;

        $claim = new Claim(888, 79.0, DateTime::createFromFormat('m-d-Y', '08-05-2010'));

        $adjudicator = new ClaimsAdjustableService();
        $adjudicator->adjudicate($pendingContract, $claim);

        $this->assertCount(0, $pendingContract->getClaims());
    }

    /**
     * @test
     */
    public function claimsAdjudicationForExpiredContract()
    {
        $pendingContract = new Contract(999, 100.0);
        $pendingContract->effectiveDate = DateTime::createFromFormat('m-d-Y', '08-05-2010');
        $pendingContract->expirationDate = DateTime::createFromFormat('m-d-Y', '08-05-2012');
        $pendingContract->status = Contract::EXPIRED;

        $claim = new Claim(888, 79.0, DateTime::createFromFormat('m-d-Y', '08-05-2010'));

        $adjudicator = new ClaimsAdjustableService();
        $adjudicator->adjudicate($pendingContract, $claim);

        $this->assertCount(0, $pendingContract->getClaims());
    }
}
