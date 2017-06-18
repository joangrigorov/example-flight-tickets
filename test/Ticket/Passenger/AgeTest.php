<?php
declare(strict_types=1);
namespace Ticket\Passenger;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class AgeTest extends TestCase
{
    public function testShouldCalculateAgeBasedOnBirthDate()
    {
        Age::setCurrentDateTime(new DateTimeImmutable('2017-05-18'));

        self::assertEquals(25, (new Age(new DateTimeImmutable('1991-09-18')))->toYears());
    }
}
