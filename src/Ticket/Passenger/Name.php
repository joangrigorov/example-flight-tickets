<?php
declare(strict_types=1);

namespace Ticket\Passenger;

class Name
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function toString(): string
    {
        return $this->name;
    }
}
