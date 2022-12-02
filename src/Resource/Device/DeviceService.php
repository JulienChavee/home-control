<?php

namespace App\Resource\Device;

class DeviceService
{
    protected string $id;
    protected ?DeviceServiceEnum $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $this->getServiceName($name);
    }

    public static function loadFromRawData($data): self
    {
        $object = new self($data['id'], '');
        $object->name = DeviceServiceEnum::tryFrom($data['name']);

        return $object;
    }

    protected function getServiceName(string $serviceName): ?DeviceServiceEnum
    {
        return match ($serviceName) {
            'device_power' => DeviceServiceEnum::battery,
            'light' => DeviceServiceEnum::light,
            default => null,
        };
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return ?DeviceServiceEnum
     */
    public function getName(): ?DeviceServiceEnum
    {
        return $this->name;
    }
}