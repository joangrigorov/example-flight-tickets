<?php
declare(strict_types=1);
namespace Flight;

use Airline\Airline;
use Airport\Airport;
use DateTimeImmutable;
use DateTimeZone;
use FastMockTrait;
use Flight\Exception\DepartureArrivalException;
use PHPUnit\Framework\TestCase;

/**
 * Tests durations between departure and arrival
 */
class DirectFlightDurationTest extends TestCase
{
    use FastMockTrait;

    public function testShouldReturnDurationWithinSameTimezone()
    {
        /** @var ReferenceID $referenceIDMock */
        /** @var Airport $airportMock */
        /** @var Airline $airlineMock */
        /** @var Price $priceMock */
        $referenceIDMock = $this->mock(ReferenceID::class);
        $airportMock = $this->mock(Airport::class);
        $airlineMock = $this->mock(Airline::class);
        $priceMock = $this->mock(Price::class);

        $timezone = new DateTimeZone('Europe/Sofia');

        $departure = new DateTimeImmutable('2017-03-03T02:30:00', $timezone);
        $arrival = new DateTimeImmutable('2017-03-03T04:30:00', $timezone);

        $flight = new DirectFlight(
            $referenceIDMock, $airportMock, $airportMock, $departure, $arrival, $airlineMock, $priceMock);

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
        /** @var Airline $airlineMock */
        /** @var Price $priceMock */
        $referenceIDMock = $this->mock(ReferenceID::class);
        $airportMock = $this->mock(Airport::class);
        $airlineMock = $this->mock(Airline::class);
        $priceMock = $this->mock(Price::class);

        $departure = new DateTimeImmutable('2017-03-03T02:30:00', new DateTimeZone('Europe/Amsterdam'));
        $arrival = new DateTimeImmutable('2017-03-03T04:30:00', new DateTimeZone('Europe/Sofia'));

        $flight = new DirectFlight(
            $referenceIDMock, $airportMock, $airportMock, $departure, $arrival, $airlineMock, $priceMock);

        $actualInterval = $flight->duration();

        self::assertEquals(1, $actualInterval->h);
        self::assertEquals(0, $actualInterval->i);
        self::assertEquals(0, $actualInterval->m);
        self::assertEquals(0, $actualInterval->y);
        self::assertEquals(0, $actualInterval->d);
        self::assertEquals(false, $actualInterval->invert);
    }

    public function testShouldThrowExceptionWhenDurationIsInverted()
    {
        /** @var ReferenceID $referenceIDMock */
        /** @var Airport $airportMock */
        /** @var Airline $airlineMock */
        /** @var Price $priceMock */
        $referenceIDMock = $this->mock(ReferenceID::class);
        $airportMock = $this->mock(Airport::class);
        $airlineMock = $this->mock(Airline::class);
        $priceMock = $this->mock(Price::class);

        $departure = new DateTimeImmutable('2017-03-03T04:30:00', new DateTimeZone('Europe/Amsterdam'));
        $arrival = new DateTimeImmutable('2017-03-03T04:30:00', new DateTimeZone('Europe/Sofia'));

        $this->expectException(DepartureArrivalException::class);

        new DirectFlight(
            $referenceIDMock, $airportMock, $airportMock, $departure, $arrival, $airlineMock, $priceMock);
    }
}
