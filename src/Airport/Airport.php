<?php
declare(strict_types=1);

namespace Airport;

class Airport
{
    private const VALIDATION_PATTERN = '/^[A-Z]{3}$/';

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

    public function equals(self $airport): bool
    {
        return $airport->iataCode === $this->iataCode;
    }

    public function toString(): string
    {
        return $this->iataCode;
    }
}
