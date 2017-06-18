<?php
declare(strict_types=1);

namespace Airline;

class Airline
{
    private const VALIDATION_PATTERN = '/^[A-Z]{2}$/';

    /**
     * @var string
     */
    private $iataCode;

    public function __construct(string $iataCode)
    {
        if (!preg_match(self::VALIDATION_PATTERN, $iataCode)) {
            throw new Exception\InvalidIATACodeException("'{$iataCode}' is invalid airport IATA code");
        }

        $this->iataCode = $iataCode;
    }
}