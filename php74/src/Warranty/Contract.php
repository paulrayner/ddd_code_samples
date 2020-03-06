<?php

declare(strict_types=1);

namespace DDDCodeSamples\Warranty;

use DateTime;

/**
 * Class Contract
 *
 * @package Warranty
 */
class Contract
{
    public const ACTIVE = 'ACTIVE';
    public const PENDING = 'PENDING';
    public const EXPIRED = 'EXPIRED';

    public int $id;
    public float $purchasePrice;
    public DateTime $effectiveDate;
    public DateTime $expirationDate;
    public DateTime $purchaseDate;
    public int $inStoreGuaranteeDays;
    public string $status;
    public Product $product;
    /** @var Claim[] */
    private array $claims = [];

    public function __construct(int $id, float $purchasePrice)
    {
        $this->id = $id;
        $this->purchasePrice = $purchasePrice;
        $this->status = self::PENDING;
    }

    public function add(Claim $claim): void
    {
        $this->claims[] = $claim;
    }

    /**
     * @return Claim[]
     */
    public function getClaims(): array
    {
        return $this->claims;
    }

    public function remove(Claim $claim): void
    {
        foreach ($this->claims as &$storedClaim) {
            if ($storedClaim->id === $claim->id) {
                unset($storedClaim);
                break;
            }
        }
    }
}
