<?php
declare(strict_types=1);

namespace Inpost;

use Exceptions\InpostCreateShipmentException;
use GuzzleHttp\Client;
use Models\Shipment;

class ShipmentClient
{
    private const string PROD_API_URL = 'https://api-shipx-pl.easypack24.net';
    private const string SANDBOX_API_URL = 'https://sandbox-api-shipx-pl.easypack24.net';
    private const string ENDPOINT_PATTERN = '/v1/organizations/%s/shipments';

    private string $endpoint;

    public function __construct(
        string $enviroment,
        string $organizationId,
        private string $apiToken,
    ) {
        $apiUrl = $enviroment === 'PROD' ? self::PROD_API_URL : self::SANDBOX_API_URL;
        $this->endpoint = $apiUrl . sprintf(self::ENDPOINT_PATTERN, $organizationId);
    }

    public function createShipment(Shipment $shipment): array
    {
        $client = new Client();
        $response = $client->request(
            'POST',
            $this->endpoint,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => $this->mapModelToRequest($shipment),
            ],
        );

        if ($response->getStatusCode() !== 201) {
            throw new InpostCreateShipmentException($response->getBody()->getContents());
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    private function mapModelToRequest(Shipment $shipment): array
    {
        return [

        ];
    }
}
