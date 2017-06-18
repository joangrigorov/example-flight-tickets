<?php
declare(strict_types=1);

namespace Flight;

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
}
