<?php
declare(strict_types=1);

namespace Models;

readonly class Weight
{
    public function __construct(
        private float $amount,
        private string $unit = 'kg',
    ) {}

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }
}
