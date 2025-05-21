<?php
declare(strict_types=1);

namespace App\Models;

readonly class MoneyData
{
    public function __construct(
        private float $amount,
        private string $currency,
    ) {}

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
