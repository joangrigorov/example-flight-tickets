<?php
declare(strict_types=1);

namespace Flight;

use DateInterval;

class CompositeFlight implements Flight
{
    /**
     * @var DirectFlight[]
     */
    private $directFlights = [];

    /**
     * @var Price
     */
    private $unitPrice;

    public function __construct(Price $unitPrice, DirectFlight ...$directFlights)
    {
        if (count($directFlights) <= 1) {
            throw new Exception\CompositeFlightException('Composite flight should have at least two direct flights');
        }

        $this->addDirectFlights(...$directFlights);
        $this->unitPrice = $unitPrice;
    }

    public function duration(): DateInterval
    {
        return $this->initialFlight()->intervalBetween($this->finalFlight());
    }

    private function initialFlight(): DirectFlight
    {
        return $this->directFlights[0];
    }

    private function finalFlight(): DirectFlight
    {
        return end($this->directFlights);
    }

    private function addDirectFlights(DirectFlight ...$directFlights): void
    {
        foreach ($directFlights as $directFlight) {
            $this->addDirectFlight($directFlight);
        }
    }

    private function addDirectFlight(DirectFlight $directFlight): void
    {
        if (count($this->directFlights) > 0 && $this->finalFlight()->hasDateTimeOverlap($directFlight)) {
            throw new Exception\DepartureArrivalException('Impossible date/times for composite flight');
        }

        $this->directFlights[] = $directFlight;
    }

    public function getUnitPrice(): Price
    {
        return $this->unitPrice;
    }

    public function toArray(): array
    {
        return [
            'ref.id' => $this->initialFlight()->getReferenceID()->toString(),
            'from' => $this->initialFlight()->getOutboundAirport()->toString(),
            'to' => $this->finalFlight()->getInboundAirport()->toString(),
            'departure' => $this->initialFlight()->getDepartureDateTime()->format('r'),
            'arrival' => $this->finalFlight()->getArrivalDateTime()->format('r'),
            'duration' => $this->duration()->format('%h hours and %i minutes'),
        ];
    }
}
