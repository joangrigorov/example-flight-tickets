<?php
declare(strict_types=1);

namespace Ticket;

use Flight\Flight;

class Ticket
{
    /**
     * @var Flight[]
     */
    private $flights;

    public function __construct(Flight ...$flights)
    {
        $this->flights = $flights;
    }


}
