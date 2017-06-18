<?php
declare(strict_types=1);
namespace Flight;

use FastMockTrait;
use PHPUnit\Framework\TestCase;
use Ticket\Collection\Passengers;
use Ticket\Passenger;

class PriceTest extends TestCase
{
    use FastMockTrait;

    public function testShouldThrowExceptionOnNegativePriceAmount()
    {
        $this->expectException(Exception\NegativePriceException::class);

        new Price(-22.3);
    }

    public function testShouldNumberFormatPrice()
    {
        self::assertEquals('322,30', (new Price(322.3))->toString());
    }

    public function testShouldApplyPassengersAndCreateNewPrice()
    {
        $price = new Price(20);
        $passengers = new Passengers($this->mock(Passenger::class), $this->mock(Passenger::class));

        self::assertEquals(new Price(40), $price->applyPassengers(...$passengers));
    }

    public function testShouldAddTwoPricesTogether()
    {
        self::assertEquals(new Price(50), (new Price(30))->add(new Price(20)));
    }
}
