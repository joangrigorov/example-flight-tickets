<?php
declare(strict_types=1);

namespace Ticket\Passenger;

use PHPUnit\Framework\TestCase;
use Ticket\Passenger\Title\Mr;
use Ticket\Passenger\Title\Mrs;
use Ticket\Passenger\Title\Ms;

class TitleTest extends TestCase
{
    public function testShouldConvertTitlesToStrings()
    {
        self::assertEquals('Mr', (new Mr())->toString());
        self::assertEquals('Ms', (new Ms())->toString());
        self::assertEquals('Mrs', (new Mrs())->toString());
    }
}
