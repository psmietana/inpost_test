<?php
declare(strict_types=1);

namespace App\Models;

interface Peer
{
    public function getFirstName(): string;

    public function getLastName(): string;

    public function getEmail(): string;

    public function getPhone(): string;

    public function getAddress(): Address;

    public function getCompanyName(): ?string;
}
