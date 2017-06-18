<?php
declare(strict_types=1);

use Airline\Airline;
use Airport\Airport;
use Flight\DirectFlight;
use Flight\Price;
use Flight\ReferenceID;
use MathieuViossat\Util\ArrayToTextTable;
use Ticket\Collection\Passengers;
use Ticket\Passenger;
use Ticket\Passenger\Age;
use Ticket\Passenger\Name;
use Ticket\Passenger\Title\Mr;
use Ticket\Ticket;

require_once __DIR__ . '/../vendor/autoload.php';

$firstFlight = new DirectFlight(
    new ReferenceID('FB82836'),
    new Airport('SOF'),
    new Airport('AMS'),
    new DateTimeImmutable('2017-01-02T11:30:00', new DateTimeZone('Europe/Sofia')),
    new DateTimeImmutable('2017-01-02T11:30:00', new DateTimeZone('Europe/Amsterdam')),
    new Airline('FB'),
    new Price(340.50)
);

$passengers = new Passengers(new Passenger(
    new Mr(), new Name('Yoan-Alexander Grigorov'), new Age(new DateTimeImmutable('1991-09-18'))));

$ticket = new Ticket($passengers, $firstFlight);

echo 'Ticket information:' . PHP_EOL;
echo "Total price: {$ticket->totalPrice()->toString()}" . PHP_EOL . PHP_EOL;

$printer = new ArrayToTextTable($passengers->toArray());
echo 'Passengers:' . PHP_EOL;
echo $printer->getTable() . PHP_EOL;
echo 'Itinerary:' . PHP_EOL;
echo $printer->getTable($ticket->getFlightsTable());
