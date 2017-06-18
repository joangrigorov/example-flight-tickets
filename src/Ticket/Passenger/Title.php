<?php
declare(strict_types=1);

namespace Ticket\Passenger;

abstract class Title
{
    /**
     * @var string
     */
    private $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function toString(): string
    {
        return $this->title;
    }
}
