<?php

namespace App\Controller;

use App\Resource\Device\Device;
use App\Resource\Device\DeviceServiceEnum;
use App\Resource\Service\Battery\Battery;
use App\Resource\Service\Light\Light;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/ajax/loaddevices', name: 'app_home_load_devices', options: ['expose' => true])]
    public function loadDevices(HttpClientInterface $client, Request $request): JsonResponse
    {
        $request = $client->request(
            'GET',
            $request->getSchemeAndHttpHost() . $this->generateUrl('api_v1_devices')
        );

        if ($request->getStatusCode() !== 200) {
            // TODO
        }

        $devices = $request->getContent(false);
        $devices = json_decode($devices, true, flags: JSON_THROW_ON_ERROR);

        $deviceList = [];
        foreach ($devices as $device) {
            $deviceList[] = new Device($device);
        }

        return $this->json($deviceList);
    }

    #[Route('/ajax/loadservice/{serviceType}/{serviceID}', name: 'app_home_load_service', options: ['expose' => true])]
    public function loadService(string $serviceType, string $serviceID, HttpClientInterface $client, Request $request, )
    {
        $request = $client->request(
            'GET',
            $request->getSchemeAndHttpHost()
            . $this->generateUrl(
                'api_v1_service_getservicestate',
                [
                    'service' => $serviceType,
                    'id' => $serviceID,
                ]
            )
        );

        if ($request->getStatusCode() !== 200) {
            // TODO
        }

        $service = $request->getContent(false);
        $service = json_decode($service, true, flags: JSON_THROW_ON_ERROR);

        $services = [];
        foreach ($service as $serviceData) {
            $services[] = $this->loadServiceClass($serviceType, $serviceData);
        }

        return $this->json($services);
    }

    protected function loadServiceClass(string $serviceType, array $data): Light|Battery
    {
        dump($data);
        switch ($serviceType) {
            case 'battery':
                return new Battery($data['state'], $data['level']);
            case 'light':
                return new Light($data['on'], $data['dimming']['brightness']);
        }
    }
}
