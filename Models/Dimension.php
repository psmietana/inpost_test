<?php
declare(strict_types=1);

namespace App\Models;

readonly class Dimension
{
    public function __construct(
        private float $length,
        private float $width,
        private float $height,
        private string $unit = 'mm',
    ) {}

    public function getLength(): float
    {
        return $this->length;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }
}
