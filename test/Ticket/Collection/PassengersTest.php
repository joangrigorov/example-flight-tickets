<?php
declare(strict_types=1);
namespace Ticket\Collection;

use FastMockTrait;
use PHPUnit\Framework\TestCase;
use Ticket\Exception\NoPassengersException;
use Ticket\Passenger;

class PassengersTest extends TestCase
{
    use FastMockTrait;

    public function testShouldThrowExceptionWhenNoPassengers()
    {
        $this->expectException(NoPassengersException::class);

        new Passengers();
    }

    public function testShouldCreateCollectionWithAtLeastOnePassenger()
    {
        $passengers = new Passengers($this->mock(Passenger::class));

        self::assertCount(1, $passengers);
    }
}
