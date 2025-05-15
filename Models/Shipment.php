<?php
declare(strict_types=1);

namespace Models;

use Enums\ShipmentAdditionalService;
use Enums\ShipmentType;

readonly class Shipment
{
    public function __construct(
        private ShipmentType $type,
        private Receiver $receiver,
        private ?Sender $sender = null,
        private array $parcels,
        private MoneyData $insurance,
        private ?array $additionalServices = null,
        private ?string $reference = null,
    ) {}

    public function getType(): ShipmentType
    {
        return $this->type;
    }

    public function getReceiver(): Receiver
    {
        return $this->receiver;
    }

    public function getSender(): ?Sender
    {
        return $this->sender;
    }

    /**
     * @return Parcel[]
     */
    public function getParcels(): array
    {
        return $this->parcels;
    }

    public function getInsurance(): MoneyData
    {
        return $this->insurance;
    }

    /**
     * @return ?ShipmentAdditionalService[]
     */
    public function getAdditionalServices(): ?array
    {
        return $this->additionalServices;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }
}
