<?php
declare(strict_types=1);

namespace Enums;

enum ShipmentType: string
{
    case INPOST_COURIER_STANDARD = 'inpost_courier_standard';
    case INPOST_COURIER_EXPRESS_1000 = 'inpost_courier_express_1000';
    case INPOST_COURIER_EXPRESS_1200 = 'inpost_courier_express_1200';
    case INPOST_COURIER_EXPRESS_1700 = 'inpost_courier_express_1700';
    case INPOST_COURIER_PALETTE = 'inpost_courier_palette';
    case INPOST_COURIER_ALCOHOL = 'inpost_courier_alcohol';
}
