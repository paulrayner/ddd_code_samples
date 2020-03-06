<?php

declare(strict_types=1);

namespace DDDCodeSamples\Warranty;

/**
 * Class ClientCompany
 *
 * @package DDDCodeSamples\Warranty
 */
class ClientCompany
{
    public string $name;
    public string $description;
    public string $code;

    public function __construct(string $name, string $description, string $code)
    {
        $this->name = $name;
        $this->description = $description;
        $this->code = $code;
    }
}
