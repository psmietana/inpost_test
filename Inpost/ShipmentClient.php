<?php
declare(strict_types=1);

namespace App\Inpost;

use App\Exceptions\InpostCreateShipmentException;
use GuzzleHttp\Client;
use App\Models\Shipment;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

readonly class ShipmentClient
{
    private const string PROD_API_URL = 'https://api-shipx-pl.easypack24.net';
    private const string SANDBOX_API_URL = 'https://sandbox-api-shipx-pl.easypack24.net';
    private const string ENDPOINT_PATTERN = '/v1/organizations/%s/shipments';

    private string $endpoint;
    private Logger $logger;

    public function __construct(
        string $environment,
        string $organizationId,
        private string $apiToken,
    ) {
        $apiUrl = $environment === 'PROD' ? self::PROD_API_URL : self::SANDBOX_API_URL;
        $this->endpoint = $apiUrl . sprintf(self::ENDPOINT_PATTERN, $organizationId);
        $this->logger = new Logger('name');
        $this->logger->pushHandler(new StreamHandler('inpost.log', Level::Warning));
    }

    public function createShipment(Shipment $shipment): array
    {
        $client = new Client();
        $requestBody = $this->mapModelToRequest($shipment);
        $this->logger->info(sprintf(
            'Endpoint: %s Request: %s',
            $this->endpoint,
            json_encode($requestBody),
        ));

        $response = $client->request(
            'POST',
            $this->endpoint,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => $requestBody,
            ],
        );

        $responseContents = $response->getBody()->getContents();
        if ($response->getStatusCode() !== 201) {
            $this->logger->error(sprintf(
                'Endpoint: %s Error: %s',
                $this->endpoint,
                $responseContents
            ));

            throw new InpostCreateShipmentException($responseContents);
        }
        $this->logger->info(sprintf(
            'Endpoint: %s Response: %s',
            $this->endpoint,
            $responseContents,
        ));

        return json_decode($responseContents, true);
    }

    private function mapModelToRequest(Shipment $shipment): array
    {
        $requestData = [
            'receiver' => [
                'company_name' => $shipment->getReceiver()->getCompanyName(),
                'first_name' => $shipment->getReceiver()->getFirstName(),
                'last_name' => $shipment->getReceiver()->getLastName(),
                'email' => $shipment->getReceiver()->getEmail(),
                'phone' => $shipment->getReceiver()->getPhone(),
                'address' => [
                    'street' => $shipment->getReceiver()->getAddress()->getStreet(),
                    'building_number' => $shipment->getReceiver()->getAddress()->getBuildingNumber(),
                    'city' => $shipment->getReceiver()->getAddress()->getCity(),
                    'post_code' => $shipment->getReceiver()->getAddress()->getPostCode(),
                    'country_code' => $shipment->getReceiver()->getAddress()->getCountryCode(),
                ],
            ],
            'insurance' => [
                'amount' => $shipment->getInsurance()->getAmount(),
                'currency' => $shipment->getInsurance()->getCurrency(),
            ],
            'service' => $shipment->getType()->value,
        ];

        $shipment->getSender() && $requestData['sender'] = [
            'company_name' => $shipment->getSender()->getCompanyName(),
            'first_name' => $shipment->getSender()->getFirstName(),
            'last_name' => $shipment->getSender()->getLastName(),
            'email' => $shipment->getSender()->getEmail(),
            'phone' => $shipment->getSender()->getPhone(),
            'address' => [
                'street' => $shipment->getSender()->getAddress()->getStreet(),
                'building_number' => $shipment->getSender()->getAddress()->getBuildingNumber(),
                'city' => $shipment->getSender()->getAddress()->getCity(),
                'post_code' => $shipment->getSender()->getAddress()->getPostCode(),
                'country_code' => $shipment->getSender()->getAddress()->getCountryCode(),
            ],
        ];

        $shipment->getReference() && $requestData['reference'] = $shipment->getReference();

        foreach ($shipment->getParcels() as $parcel) {
            $requestData['parcels'][] = [
                'dimensions' => [
                    'length' => $parcel->getDimension()->getLength(),
                    'width' => $parcel->getDimension()->getWidth(),
                    'height' => $parcel->getDimension()->getHeight(),
                    'unit' => $parcel->getDimension()->getUnit(),
                ],
                'weight' => [
                    'amount' => $parcel->getWeight()->getAmount(),
                    'unit' => $parcel->getWeight()->getUnit(),
                ],
            ];
        }

        foreach ($shipment->getAdditionalServices() as $service) {
            $requestData['additionalServices'][] = [
                $service->value,
            ];
        }

        return $requestData;
    }
}
