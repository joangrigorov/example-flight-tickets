<?php
declare(strict_types=1);

namespace Flight;

class ReferenceID
{
    /**
     * @var string
     */
    private $identifier;

    public function __construct(string $identifier)
    {
        $this->identifier = $identifier;
    }

    public function toString(): string
    {
        return $this->identifier;
    }
}
