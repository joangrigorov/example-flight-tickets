<?php
declare(strict_types=1);
namespace Ticket;

use FastMockTrait;
use Flight\Flight;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use Ticket\Collection\Passengers;

class TicketFlightSizeTest extends TestCase
{
    use FastMockTrait;

    public function testShouldNotAllowTicketsWithoutAnyFlights()
    {
        $this->expectException(Exception\NoFlightsException::class);

        new Ticket($this->passengersMock());
    }

    public function testCreateTicketWithAtLeastOneFlight()
    {
        $ticket = new Ticket($this->passengersMock(), $this->mock(Flight::class));

        self::assertNotNull($ticket);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Passengers
     */
    protected function passengersMock(): Passengers
    {
        return $this->mock(Passengers::class);
    }
}
