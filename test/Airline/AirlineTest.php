<?php
declare(strict_types=1);
namespace Airline;

use PHPUnit\Framework\TestCase;

class AirlineTest extends TestCase
{
    public function testShouldThrowExceptionWhenIataCodeIsInvalid()
    {
        $this->expectException(Exception\InvalidIATACodeException::class);

        new Airline('InvalidIataCode');
    }

    public function testShouldThrowNotThrowExceptionWhenIataCodeIsValid()
    {
        $arline = new Airline('FB');
        self::assertInstanceOf(Airline::class, $arline);
    }
}
