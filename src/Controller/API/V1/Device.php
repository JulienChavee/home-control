<?php

namespace App\Controller\API\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class Device extends AbstractController
{
    use API1;

    #[Route('/api/v1/devices' , name: 'api_v1_devices', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $devices = $this->callAPI('GET', 'device');

        $devices = json_decode($devices, true, flags: JSON_THROW_ON_ERROR);

        $devicesList = [];
        foreach ($devices['data'] as $device) {
            $devicesList[] = \App\Resource\Device\Device::loadFromRawData($device);
        }

        return $this->json($devicesList);
    }
}