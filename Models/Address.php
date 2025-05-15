<?php
declare(strict_types=1);

namespace Models;

readonly class Address
{
    public function __construct(
        private ?string $id = null,
        private string $street,
        private string $buildingNumber,
        private string $city,
        private string $postCode,
        private string $countryCode,
    ) {}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getBuildingNumber(): string
    {
        return $this->buildingNumber;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPostCode(): string
    {
        return $this->postCode;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}
