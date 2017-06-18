<?php
declare(strict_types=1);

namespace Ticket;

use Ticket\Passenger\Title;
use Ticket\Passenger\Name;
use Ticket\Passenger\Age;

class Passenger
{
    /**
     * @var Title
     */
    private $title;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var Age
     */
    private $age;

    public function __construct(Title $title, Name $name, Age $age)
    {
        $this->title = $title;
        $this->name = $name;
        $this->age = $age;
    }
}
