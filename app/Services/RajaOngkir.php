<?php

namespace App\Services;

use GuzzleHttp\Client;

class RajaOngkir
{
    private $apiKey;
    private $client;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client();
    }

    public function getCities()
    {
        $url = 'https://api.rajaongkir.com/starter/city';

        $headers = [
            'key' => $this->apiKey,
        ];

        try {
            $response = $this->client->get($url, [
                'headers' => $headers,
            ]);
            $data = json_decode($response->getBody()->getContents(), true);

            if ($data['rajaongkir']['status']['code'] === 200) {
                return $data['rajaongkir']['results'];
            } else {
                throw new \Exception('RajaOngkir API error: ' . $data['rajaongkir']['status']['description']);
            }
        } catch (\Exception $e) {
            report($e); // Or handle the exception as needed
            return []; // Or throw a custom exception
        }
    }

    public function getProvinces()
    {
        $url = 'https://api.rajaongkir.com/starter/province';

        $headers = [
            'key' => $this->apiKey,
        ];

        try {
            $response = $this->client->get($url, [
                'headers' => $headers,
            ]);
            $data = json_decode($response->getBody()->getContents(), true);

            if ($data['rajaongkir']['status']['code'] === 200) {
                return $data['rajaongkir']['results'];
            } else {
                throw new \Exception('RajaOngkir API error: ' . $data['rajaongkir']['status']['description']);
            }
        } catch (\Exception $e) {
            report($e); // Or handle the exception as needed
            return []; // Or throw a custom exception
        }
    }

    public function postCost($destinationId) {
        $url = 'https://api.rajaongkir.com/starter/cost';

        $formData = [
            'origin' => 444,
            'destination' => $destinationId,
            'weight' => 500,
            'courier' => 'jne',
        ];

        $headers = [
            'key' => $this->apiKey,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        try {
            $response = $this->client->post($url, [
                'headers' => $headers,
                'form_params' => $formData,
            ]);
            $data = json_decode($response->getBody()->getContents(), true);

            if ($data['rajaongkir']['status']['code'] === 200) {
                return $data['rajaongkir']['results'][0]['costs'];
            } else {
                throw new \Exception('RajaOngkir API error: ' . $data['rajaongkir']['status']['description']);
            }
        } catch (\Exception $e) {
            report($e); // Or handle the exception as needed
            return []; // Or throw a custom exception
        }
    }
}
