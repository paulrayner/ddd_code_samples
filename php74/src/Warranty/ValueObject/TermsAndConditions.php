<?php

declare(strict_types=1);

namespace DDDCodeSamples\Warranty\ValueObject;

use DateInterval;
use DateTimeImmutable;
use DDDCodeSamples\Warranty\Interfaces\ValueObject;

/**
 * Class TermsAndConditions
 *
 * @package DDDCodeSamples\Warranty\ValueObject
 */
final class TermsAndConditions implements ValueObject
{
    private DateTimeImmutable $effectiveDate;
    private DateTimeImmutable $expirationDate;
    private DateTimeImmutable $purchaseDate;
    private DateInterval $inStoreGuaranteeDuration;

    private function __construct(
        DateTimeImmutable $effectiveDate,
        DateTimeImmutable $expirationDate,
        DateTimeImmutable $purchaseDate,
        DateInterval $inStoreGuaranteeDuration
    ) {
        $this->effectiveDate = $effectiveDate->setTime(0, 0);
        $this->expirationDate = $expirationDate->setTime(0, 0);
        $this->purchaseDate = $purchaseDate->setTime(0, 0);
        $this->inStoreGuaranteeDuration = $inStoreGuaranteeDuration;
    }

    public function extendAnnually(): self
    {
        return new static(
            $this->effectiveDate,
            $this->expirationDate->add(DateInterval::createFromDateString('1 year')),
            $this->purchaseDate,
            $this->inStoreGuaranteeDuration
        );
    }

    public function getInStoreGuaranteeInDays(): int
    {
        return $this->inStoreGuaranteeDuration->days;
    }

    public function isActive(DateTimeImmutable $compareDate): bool
    {
        return $this->effectiveDate <= $compareDate && $this->expirationDate >= $compareDate;
    }

    public function isSame(ValueObject $object): bool
    {
        return $object instanceof self &&
            $this->effectiveDate === $object->getEffectiveDate() &&
            $this->expirationDate === $object->getExpirationDate() &&
            $this->purchaseDate === $object->getPurchaseDate() &&
            $this->inStoreGuaranteeDuration === $object->getInStoreGuaranteeDuration();
    }

    public function getEffectiveDate(): DateTimeImmutable
    {
        return $this->effectiveDate;
    }

    public function getExpirationDate(): DateTimeImmutable
    {
        return $this->expirationDate;
    }

    public function getPurchaseDate(): DateTimeImmutable
    {
        return $this->purchaseDate;
    }

    public function getInStoreGuaranteeDuration(): DateInterval
    {
        return $this->inStoreGuaranteeDuration;
    }

    public static function set(
        DateTimeImmutable $effectiveDate,
        DateTimeImmutable $expirationDate,
        DateTimeImmutable $purchaseDate,
        DateInterval $inStoreGuaranteeDuration
    ): self {
        return new static($effectiveDate, $expirationDate, $purchaseDate, $inStoreGuaranteeDuration);
    }


}
