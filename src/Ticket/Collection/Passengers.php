<?php
declare(strict_types=1);

namespace Ticket\Collection;

use ArrayObject;
use Ticket\Exception\NoPassengersException;
use Ticket\Passenger;

class Passengers extends ArrayObject
{
    /**
     * Passengers constructor.
     * @param Passenger[] $passengers
     */
    public function __construct(Passenger ...$passengers)
    {
        if (count($passengers) === 0) {
            throw new NoPassengersException('At least one passenger is required');
        }

        parent::__construct($passengers);
    }
}
