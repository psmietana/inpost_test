<?php
declare(strict_types=1);

namespace App\Models;

readonly class Parcel
{
    public function __construct(
        private ?string $id = null,
        private Dimension $dimension,
        private Weight  $weight,
        private ?string $trackingNumber = null,
    ) {}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDimension(): Dimension
    {
        return $this->dimension;
    }

    public function getWeight(): Weight
    {
        return $this->weight;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }
}
