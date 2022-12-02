<?php

namespace App\Resource\Service\Battery;

class Battery
{
    protected BatteryStateEnum $state;
    protected int $level;

    public function __construct(string $state, int $level)
    {
        $this->state = BatteryStateEnum::tryFrom($state);
        $this->level = $level;
    }

    /**
     * @return BatteryStateEnum
     */
    public function getState(): BatteryStateEnum
    {
        return $this->state;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }
}