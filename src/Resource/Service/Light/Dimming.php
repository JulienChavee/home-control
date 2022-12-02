<?php

namespace App\Resource\Service\Light;

class Dimming
{
    protected int $brightness;
    protected int $minDimLevel;

    public function __construct(int $brightness, int $minDimLevel)
    {
        $this->brightness = $brightness;
        $this->minDimLevel = $minDimLevel;
    }

    /**
     * @return int
     */
    public function getBrightness(): int
    {
        return $this->brightness;
    }

    /**
     * @return int
     */
    public function getMinDimLevel(): int
    {
        return $this->minDimLevel;
    }
}