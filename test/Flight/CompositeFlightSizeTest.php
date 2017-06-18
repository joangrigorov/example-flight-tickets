<?php
declare(strict_types=1);
namespace Flight;

use FastMockTrait;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class CompositeFlightSizeTest extends TestCase
{
    use FastMockTrait;

    public function testShouldNotCreateCompositeFlightWithZeroDirectFlights()
    {
        $this->expectException(Exception\CompositeFlightException::class);
        new CompositeFlight($this->priceMock());
    }

    public function testShouldNotCreateCompositeFlightWithOneDirectFlights()
    {
        $this->expectException(Exception\CompositeFlightException::class);
        new CompositeFlight($this->priceMock(), $this->mock(DirectFlight::class));
    }

    /**
     * @return Price|PHPUnit_Framework_MockObject_MockObject
     */
    private function priceMock(): Price
    {
        return $this->mock(Price::class);
    }
}
