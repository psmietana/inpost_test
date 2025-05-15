<?php
require __DIR__ . '/vendor/autoload.php';

use Inpost\ShipmentClient;
use Shipment\ShipmentCreator;

$createdShipment = (new ShipmentClient('dev', 123, 'token'))
    ->createShipment((new ShipmentCreator())->createShipment());
