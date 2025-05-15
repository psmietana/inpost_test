<?php
declare(strict_types=1);

namespace Enums;

enum ShipmentAdditionalService: string
{
    case SMS = 'sms';
    case EMAIL = 'email';
    case SATURDAY = 'saturday';
}
