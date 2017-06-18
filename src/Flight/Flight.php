<?php
declare(strict_types=1);

namespace Flight;

use DateInterval;

interface Flight
{
    public function duration(): DateInterval;

    public function getUnitPrice(): Price;
}
