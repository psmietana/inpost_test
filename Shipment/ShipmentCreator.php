<?php
declare(strict_types=1);

namespace App\Shipment;

use App\Enums\ShipmentAdditionalService;
use App\Enums\ShipmentType;
use App\Models\Address;
use App\Models\Dimension;
use App\Models\MoneyData;
use App\Models\Parcel;
use App\Models\Receiver;
use App\Models\Sender;
use App\Models\Shipment;
use App\Models\Weight;

class ShipmentCreator
{
    public function createShipment(): Shipment
    {
        return new Shipment(
            ShipmentType::INPOST_COURIER_STANDARD,
            $this->createReceiver(),
            $this->createSender(),
            $this->createParcels(),
            new MoneyData(1.00, 'PLN'),
            $this->createAdditionalServices(),
            'NUMER-123321-ZAMOWIENIA',
        );
    }

    public function createReceiver(): Receiver
    {
        return new Receiver(
            'imię1',
            'nazwisko1',
            'imie1.nazwisko1@mail.pl',
            '123456789',
            new Address(street: 'ulica1', buildingNumber: '1', city: 'Poznań', postCode: '61-111', countryCode: 'PL'),
        );
    }

    public function createSender(): Sender
    {
        return new Sender(
            'imię2',
            'nazwisko2',
            'imie2.nazwisko2@mail.pl',
            '987654321',
            new Address(street: 'ulica2', buildingNumber: '2', city: 'Poznań', postCode: '61-222', countryCode: 'PL'),
        );
    }

    public function createParcels(): array
    {
        return [
            new Parcel(
                dimension: new Dimension(100.0, 100.0, 100.0),
                weight: new Weight(10.0),
            ),
        ];
    }

    public function createAdditionalServices(): array
    {
        return [
            ShipmentAdditionalService::SMS,
            ShipmentAdditionalService::EMAIL,
        ];
    }
}
