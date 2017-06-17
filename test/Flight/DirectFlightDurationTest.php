<?php
declare(strict_types=1);
namespace Flight;

use Aircraft\SeatMap;
use Airline\Airline;
use Airport\Airport;
use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Tests durations between departure and arrival
 */
class DirectFlightDurationTest extends TestCase
{
    public function testShouldReturnDurationWithinSameTimezone()
    {
        /** @var ReferenceID $referenceIDMock */
        /** @var Airport $airportMock */
        /** @var SeatMap $seatMapMock */
        /** @var Airline $airlineMock */
        $referenceIDMock = $this->mock(ReferenceID::class);
        $airportMock = $this->mock(Airport::class);
        $seatMapMock = $this->mock(SeatMap::class);
        $airlineMock = $this->mock(Airline::class);

        $timezone = new DateTimeZone('Europe/Sofia');

        $departureDT = new DateTimeImmutable('2017-03-03T02:30:00', $timezone);
        $arrivalDT = new DateTimeImmutable('2017-03-03T04:30:00', $timezone);

        $flight = new DirectFlight(
            $referenceIDMock, $airportMock, $airportMock, $departureDT, $arrivalDT, $seatMapMock, $airlineMock);

        $actualInterval = $flight->duration();

        self::assertEquals(2, $actualInterval->h);
        self::assertEquals(0, $actualInterval->i);
        self::assertEquals(0, $actualInterval->m);
        self::assertEquals(0, $actualInterval->y);
        self::assertEquals(0, $actualInterval->d);
        self::assertEquals(false, $actualInterval->invert);
    }

    public function testShouldReturnDurationBetweenTimezones()
    {
        /** @var ReferenceID $referenceIDMock */
        /** @var Airport $airportMock */
        /** @var SeatMap $seatMapMock */
        /** @var Airline $airlineMock */
        $referenceIDMock = $this->mock(ReferenceID::class);
        $airportMock = $this->mock(Airport::class);
        $seatMapMock = $this->mock(SeatMap::class);
        $airlineMock = $this->mock(Airline::class);

        $departureDT = new DateTimeImmutable('2017-03-03T02:30:00', new DateTimeZone('Europe/Amsterdam'));
        $arrivalDT = new DateTimeImmutable('2017-03-03T04:30:00', new DateTimeZone('Europe/Sofia'));

        $flight = new DirectFlight(
            $referenceIDMock, $airportMock, $airportMock, $departureDT, $arrivalDT, $seatMapMock, $airlineMock);

        $actualInterval = $flight->duration();

        self::assertEquals(1, $actualInterval->h);
        self::assertEquals(0, $actualInterval->i);
        self::assertEquals(0, $actualInterval->m);
        self::assertEquals(0, $actualInterval->y);
        self::assertEquals(0, $actualInterval->d);
        self::assertEquals(false, $actualInterval->invert);
    }

    /**
     * @param string $className
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    private function mock(string $className): PHPUnit_Framework_MockObject_MockObject
    {
        return $this->getMockBuilder($className)->disableOriginalConstructor()->getMock();
    }
}
