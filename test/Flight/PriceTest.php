<?php
declare(strict_types=1);
namespace Flight;

use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    public function testShouldThrowExceptionOnNegativePriceAmount()
    {
        $this->expectException(Exception\NegativePriceException::class);

        new Price(-22.3);
    }

    public function testShouldNumberFormatPrice()
    {
        self::assertEquals('322,30', (new Price(322.3))->toString());
    }
}
