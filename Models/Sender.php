<?php
declare(strict_types=1);

namespace App\Models;

readonly class Sender implements Peer
{
    public function __construct(
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $phone,
        private Address $address,
        private ?string $companyName = null,
    ) {}

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }
}
