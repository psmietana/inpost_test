<?php
declare(strict_types=1);

namespace App\Enums;

enum ShipmentAdditionalService: string
{
    case SMS = 'sms';
    case EMAIL = 'email';
    case SATURDAY = 'saturday';
}
