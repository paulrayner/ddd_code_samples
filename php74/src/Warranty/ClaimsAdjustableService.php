<?php

declare(strict_types=1);

namespace DDDCodeSamples\Warranty;

/**
 * Class ClaimsAdjustableService
 *
 * @package Warranty
 */
class ClaimsAdjustableService
{
    public function adjudicate(Contract $contract, Claim $newClaim): void
    {
        $claimTotal = 0;
        $claims = $contract->getClaims();

        foreach ($claims as $claim) {
            $claimTotal += $claim->amount;
        }

        if ((($contract->purchasePrice - $claimTotal) * 0.8 > $newClaim->amount) &&
            ($newClaim->date >= $contract->effectiveDate) &&
            ($newClaim->date <= $contract->expirationDate) &&
            ($contract->status === Contract::ACTIVE)) {
            $contract->add($newClaim);
        }
    }
}


