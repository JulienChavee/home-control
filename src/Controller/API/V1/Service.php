<?php

namespace App\Controller\API\V1;

use App\Resource\Service\Battery\Battery;
use App\Resource\Service\Light\Light;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class Service extends AbstractController
{
    use API1;

    #[Route('/api/v1/service' , name: 'api_v1_service', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $services = [
            'battery'
        ];

        return $this->json($services);
    }

    #[Route('/api/v1/service/{service}/{id}' , name: 'api_v1_service_getservicestate', methods: ['GET'])]
    public function getServiceState(string $service, string $id): JsonResponse
    {
        $return = $this->dispatchService($service, $id);

        return $this->json($return);
    }

    protected function dispatchService(string $service, string $id): mixed
    {
        switch ($service)
        {
            case 'battery':
                return $this->getBattery($id);
            case 'light':
                return $this->getLight($id);
        }
    }

    /**
     * @param string $id
     * @return Battery[]
     * @throws \JsonException
     */
    protected function getBattery(string $id): array
    {
        $values = $this->callAPI(
            'GET',
            'device_power/' . $id
        );

        $values = json_decode($values, true, flags: JSON_THROW_ON_ERROR);

        $services = [];

        foreach ($values['data'] as $data) {
            $services[] = new Battery(
                $data['power_state']['battery_state'],
                (int) $data['power_state']['battery_level'],
            );
        }

        return $services;
    }

    /**
     * @param string $id
     * @return Light[]
     * @throws \JsonException
     */
    protected function getLight(string $id): array
    {
        $values = $this->callAPI(
            'GET',
            'light/' . $id
        );

        $values = json_decode($values, true, flags: JSON_THROW_ON_ERROR);

        $services = [];

        foreach ($values['data'] as $data) {
            $services[] = new Light(
                $data['on']['on'],
                $data['dimming']['brightness'],
            );
        }

        return $services;
    }
}