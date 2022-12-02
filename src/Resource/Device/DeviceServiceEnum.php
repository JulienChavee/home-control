<?php

namespace App\Resource\Device;

enum DeviceServiceEnum: string
{
    case battery = 'battery';
    case motion = 'motion';
    case light = 'light';
}
