<?php

namespace App\Resource\Device;

class Device
{
    protected string $id;
    protected string $name;
    protected ?DeviceTypeEnum $type;
    /** @var DeviceService[] */
    protected array $services = [];

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;

        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id':
                    $this->id = $value;
                    break;
                case 'name':
                    $this->name = $value;
                    break;
                case 'type':
                    $this->type = $value ?DeviceTypeEnum::tryFrom($value) : null;
                    break;
                    break;
                case 'services':
                    foreach ($value as $service) {
                        $deviceService = DeviceService::loadFromRawData($service);

                        if ($deviceService->getName()) {
                            $this->services[] = $deviceService;
                        }
                    }
                    break;

            }
        }
    }

    public static function loadFromRawData(array $rawData): self
    {
        $object = new self([]);
        $object->rawData = $rawData;

        foreach ($rawData as $key => $value) {
            switch ($key) {
                case 'id':
                    $object->id = $value;
                    break;
                case 'metadata':
                    $object->name = $value['name'];
                    break;
                case 'product_data':
                    $object->type = $object->getDeviceType($value['product_name']);
                    break;
                case 'services':
                    foreach ($value as $service) {
                        $deviceService = new DeviceService($service['rid'], $service['rtype']);

                        if ($deviceService->getName()) {
                            $object->services[] = $deviceService;
                        }
                    }
                    break;
            }
        }

        return $object;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DeviceTypeEnum|null
     */
    public function getType(): ?DeviceTypeEnum
    {
        return $this->type;
    }

    /**
     * @return DeviceServiceEnum[]
     */
    public function getServices(): array
    {
        return $this->services;
    }

    protected function getDeviceType(string $productName): ?DeviceTypeEnum
    {
        switch ($productName) {
            case 'Hue ambiance lamp':
                return DeviceTypeEnum::lightbulb;
            case 'Hue dimmer switch':
                return DeviceTypeEnum::dimmerswitch;
            case 'Hue lightstrip plus':
                return DeviceTypeEnum::lightstrip;
            case 'Hue motion sensor':
                return DeviceTypeEnum::motionsensor;
            case 'Hue ambiance spot':
                return DeviceTypeEnum::lightspot;
            case 'Hue outdoor wall':
                return DeviceTypeEnum::lightoutdoorwall;
            default:
                return null;
        }
    }
}