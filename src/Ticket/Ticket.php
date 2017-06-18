<?php
declare(strict_types=1);

namespace Ticket;

use Flight\Flight;
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
}
