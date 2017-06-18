<?php
declare(strict_types=1);

namespace Flight;

use Ticket\Passenger;

class Price
{
    /**
     * @var float
     */
    private $amount;

    public function __construct(float $amount)
    {
        if ($amount < 0) {
            throw new Exception\NegativePriceException('Price cannot be a negative value');
        }

        $this->amount = $amount;
    }

    public function toString(): string
    {
        return number_format($this->amount, 2, ',', ' ');
    }

    public function applyPassengers(Passenger ...$passengers): self
    {
        return new static(count($passengers) * $this->amount);
    }

    public function add(?Price $price): self
    {
        if (null === $price) {
            return new static($this->amount);
        }

        return new static($this->amount + $price->amount);
    }
}
