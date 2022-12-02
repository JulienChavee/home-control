<?php

namespace App\Controller\API\V1;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

trait API1 {
    protected string $version = '1.0';
    protected HttpClientInterface $client;
    protected ContainerBagInterface $params;

    public function __construct(HttpClientInterface $client, ContainerBagInterface $params)
    {
        $this->client = $client;
        $this->params = $params;
    }

    public function callAPI(string $method, string $endpoint): string
    {
        try {
            $request = $this->client->request(
                $method,
                'https://192.168.1.41/clip/v2/resource/' . $endpoint,
                [
                    'headers' => [
                        'hue-application-key' => $this->params->get('api')['hue']['key'],
                    ],
                    'verify_host' => false, // TODO
                    'verify_peer' => false, // TODO
                ]
            );

            if ($request->getStatusCode() !== 200) {
                // TODO
                throw new \Exception($request->getStatusCode());
            }

            return $request->getContent(false);
        } catch (TransportException $e) {
            // TODO
            throw $e;
        }
    }
}