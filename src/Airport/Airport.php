<?php
declare(strict_types=1);

namespace Airport;

class Airport
{
    /**
     * @var string
     */
    private $iataCode;

    public function __construct(string $iataCode)
    {
        if (!preg_match('/^[A-Z]{3}$/', $iataCode)) {
            throw new Exception\InvalidIATACodeException("'{$iataCode}' is invalid airport IATA code");
        }

        $this->iataCode = $iataCode;
    }

    public function equals(self $airport): bool
    {
        return $airport->iataCode === $this->iataCode;
    }
}