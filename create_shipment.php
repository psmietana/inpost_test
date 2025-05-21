<?php
namespace App;
require __DIR__ . '/vendor/autoload.php';


use App\Inpost\ShipmentClient;
use App\Shipment\ShipmentCreator;

$createdShipment = (new ShipmentClient('dev', 123, 'token'))->createShipment(
    (new ShipmentCreator())->createShipment()
);
