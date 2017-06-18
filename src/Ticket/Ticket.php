<?php
declare(strict_types=1);

namespace Ticket;

use Flight\Flight;
use Flight\Price;
use Ticket\Collection\Passengers;
use Ticket\Exception\NoFlightsException;

class Ticket
{
    /**
     * @var Flight[]
     */
    private $flights;

    /**
     * @var Passengers
     */
    private $passengers;

    public function __construct(Passengers $passengers, Flight ...$flights)
    {
        if (count($flights) === 0) {
            throw new NoFlightsException('Cannot create ticket without flights');
        }

        $this->flights = $flights;
        $this->passengers = $passengers;
    }

    public function totalPrice(): Price
    {
        $ticketPrice = null;
        foreach ($this->flights as $flight)
        {
            $flightPrice = $flight->getUnitPrice();
            $withPassengersPrice = $flightPrice->applyPassengers(...$this->passengers);

            $ticketPrice = $withPassengersPrice->add($ticketPrice);
        }

        return $ticketPrice;
    }

    public function getFlightsTable(): array
    {
        $table = [];
        foreach ($this->flights as $flight) {
            $table[] = $flight->toArray();
        }

        return $table;
    }
}
