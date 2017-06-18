<?php
declare(strict_types=1);

namespace Flight;

use Aircraft\SeatMap;
use Airline\Airline;
use Airport\Airport;
use DateInterval;
use DateTimeInterface;
use Flight\Exception\DepartureArrivalException;
use Flight\Exception\SameAirportException;
use InvalidArgumentException;

class DirectFlight implements Flight
{
    /**
     * @var ReferenceID
     */
    private $referenceID;

    /**
     * @var Airport
     */
    private $outboundAirport;

    /**
     * @var Airport
     */
    private $inboundAirport;

    /**
     * @var DateTimeInterface
     */
    private $departureDateTime;

    /**
     * @var DateTimeInterface
     */
    private $arrivalDateTime;

    /**
     * @var SeatMap
     */
    private $seatMap;

    /**
     * @var Airline
     */
    private $airline;

    /**
     * @var Price
     */
    private $unitPrice;

    public function __construct(
        ReferenceID $referenceID,
        Airport $outboundAirport,
        Airport $inboundAirport,
        DateTimeInterface $departureDateTime,
        DateTimeInterface $arrivalDateTime,
        SeatMap $seatMap,
        Airline $airline,
        Price $unitPrice)
    {
        if ($inboundAirport->equals($outboundAirport)) {
            throw new SameAirportException('Outbound and inbound airports cannot be the same');
        }

        if ($departureDateTime >= $arrivalDateTime) {
            throw new DepartureArrivalException('Departure cannot be after arrival');
        }

        $this->referenceID = $referenceID;
        $this->outboundAirport = $outboundAirport;
        $this->inboundAirport = $inboundAirport;
        $this->departureDateTime = $departureDateTime;
        $this->arrivalDateTime = $arrivalDateTime;
        $this->seatMap = $seatMap;
        $this->airline = $airline;
        $this->unitPrice = $unitPrice;
    }

    public function duration(): DateInterval
    {
        return $this->intervalBetween($this);
    }

    public function intervalBetween(self $flight): DateInterval
    {
        return $this->departureDateTime->diff($flight->arrivalDateTime);
    }

    public function hasDateTimeOverlap(DirectFlight $directFlight): bool
    {
        return $this->arrivalDateTime > $directFlight->departureDateTime;
    }

    public function getUnitPrice(): Price
    {
        return $this->unitPrice;
    }
}
