<?php

namespace App\Resource\Device;

enum DeviceTypeEnum: string
{
    case lightbulb = 'light_bulb';
    case motionsensor = 'motion_sensor';
    case lightspot = 'light_spot';
    case dimmerswitch = 'dimmer_switch';
    case lightstrip = 'light_strip';
    case lightoutdoorwall = 'light_outdoor_wall';
}
