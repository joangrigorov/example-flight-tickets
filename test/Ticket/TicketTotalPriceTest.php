<?php
declare(strict_types=1);

namespace Ticket;

use FastMockTrait;
use Flight\Flight;
use Flight\Price;
use PHPUnit\Framework\TestCase;
use Ticket\Collection\Passengers;

class TicketTotalPriceTest extends TestCase
{
    use FastMockTrait;

    public function testShouldCalculateTotalPriceOfOneFlightAndOnePassenger()
    {
        $flightMock = $this->mock(Flight::class);
        $flightMock->method('getUnitPrice')->willReturn(new Price(20));

        $passengers = new Passengers($this->mock(Passenger::class));

        $ticket = new Ticket($passengers, $flightMock);

        self::assertEquals(new Price(20), $ticket->totalPrice());
    }

    public function testShouldCalculateTotalPriceOfTwoFlightsAndOnePassenger()
    {
        $firstFlightMock = $this->mock(Flight::class);
        $firstFlightMock->method('getUnitPrice')->willReturn(new Price(20));

        $secondFlightMock = $this->mock(Flight::class);
        $secondFlightMock->method('getUnitPrice')->willReturn(new Price(20));

        $passengers = new Passengers($this->mock(Passenger::class));

        $ticket = new Ticket($passengers, $firstFlightMock, $secondFlightMock);

        self::assertEquals(new Price(40), $ticket->totalPrice());
    }

    public function testShouldCalculateTotalPriceOfTwoFlightsAndTwoPassenger()
    {
        $firstFlightMock = $this->mock(Flight::class);
        $firstFlightMock->method('getUnitPrice')->willReturn(new Price(20));

        $secondFlightMock = $this->mock(Flight::class);
        $secondFlightMock->method('getUnitPrice')->willReturn(new Price(20));

        $passengers = new Passengers($this->mock(Passenger::class), $this->mock(Passenger::class));

        $ticket = new Ticket($passengers, $firstFlightMock, $secondFlightMock);

        self::assertEquals(new Price(80), $ticket->totalPrice());
    }
}
