<?php

namespace App\Resource\Service\Light;

class Light
{
    protected bool $isOn;
    protected Dimming $dimming;

    public function __construct(bool $isOn, int $brightness)
    {
        $this->isOn = $isOn;
        $this->dimming = new Dimming($brightness, 0);
    }

    /**
     * @return bool
     */
    public function isOn(): bool
    {
        return $this->isOn;
    }

    /**
     * @return Dimming
     */
    public function getDimming(): Dimming
    {
        return $this->dimming;
    }
}