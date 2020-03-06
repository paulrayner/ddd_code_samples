<?php

declare(strict_types=1);

namespace DDDCodeSamples\Warranty;

/**
 * Class Product
 *
 * @package Warranty
 */
class Product
{
    public string $name;
    public string $serialNumber;
    public string $make;
    public string $model;

    public function __construct(string $name, string $serialNumber, string $make, string $model)
    {
        $this->name = $name;
        $this->serialNumber = $serialNumber;
        $this->make = $make;
        $this->model = $model;
    }
}
