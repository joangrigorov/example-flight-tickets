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

    public function testShouldThrowNotThrowExceptionWhenIataCodeIsValid()
    {
        $arline = new Airport('SOF');
        self::assertInstanceOf(Airport::class, $arline);
    }

    public function testShouldAssertFalseWhenAirportsDoNotMatch()
    {
        self::assertFalse((new Airport('SOF'))->equals(new Airport('LHX')));
    }

    public function testShouldAssertTrueWhenAirportsDoNotMatch()
    {
        self::assertTrue((new Airport('SOF'))->equals(new Airport('SOF')));
    }
}
