<?php

namespace App\Resource\Service\Battery;

enum BatteryStateEnum: string
{
    case normal = 'normal';
    case low = 'low';
    case critical = 'critical';
}
