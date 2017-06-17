<?php
declare(strict_types=1);

namespace Flight;

use Aircraft\SeatMap;
use Airline\Airline;
use Airport\Airport;
use DateInterval;
use DateTimeInterface;

class DirectFlight
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

    public function __construct(
        ReferenceID $referenceID,
        Airport $outboundAirport,
        Airport $inboundAirport,
        DateTimeInterface $departureDateTime,
        DateTimeInterface $arrivalDateTime,
        SeatMap $seatMap,
        Airline $airline)
    {
        $this->referenceID = $referenceID;
        $this->outboundAirport = $outboundAirport;
        $this->inboundAirport = $inboundAirport;
        $this->departureDateTime = $departureDateTime;
        $this->arrivalDateTime = $arrivalDateTime;
        $this->seatMap = $seatMap;
        $this->airline = $airline;
    }

    public function duration(): DateInterval
    {
        return $this->departureDateTime->diff($this->arrivalDateTime);
    }
}
