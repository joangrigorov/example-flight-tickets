<?php
declare(strict_types=1);

namespace Ticket\Passenger;

use DateTimeImmutable;
use DateTimeInterface;

class Age
{
    /**
     * @var integer
     */
    private $age;

    /**
     * @var DateTimeInterface
     */
    private static $currentDate;

    public function __construct(DateTimeInterface $birthDate)
    {
        $this->age = $birthDate->diff($this->currentDate())->y;
    }

    /**
     * @param DateTimeInterface $currentDate
     */
    public static function setCurrentDateTime(DateTimeInterface $currentDate)
    {
        self::$currentDate = $currentDate;
    }

    public function toYears(): int
    {
        return $this->age;
    }

    protected function currentDate(): DateTimeInterface
    {
        return is_null(self::$currentDate) ? new DateTimeImmutable('now') : self::$currentDate;
    }
}
