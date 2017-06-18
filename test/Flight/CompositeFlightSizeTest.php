<?php
declare(strict_types=1);
namespace Flight;

use FastMockTrait;
use PHPUnit\Framework\TestCase;

class CompositeFlightSizeTest extends TestCase
{
    use FastMockTrait;

    public function testShouldNotCreateCompositeFlightWithZeroDirectFlights()
    {
        $this->expectException(Exception\CompositeFlightException::class);
        new CompositeFlight();
    }

    public function testShouldNotCreateCompositeFlightWithOneDirectFlights()
    {
        $this->expectException(Exception\CompositeFlightException::class);
        new CompositeFlight($this->mock(DirectFlight::class));
    }
}
