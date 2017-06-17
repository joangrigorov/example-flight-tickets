<?php
declare(strict_types=1);
namespace Airport;

use PHPUnit\Framework\TestCase;

class AirportTest extends TestCase
{
    public function testShouldThrowExceptionWhenIataCodeIsInvalid()
    {
        $this->expectException(Exception\InvalidIATACodeException::class);

        new Airport('InvalidIataCode');
    }
}
