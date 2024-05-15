<?php

namespace App\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class ExternalApiCallHelper
{
	public static function callApi($method, $url, $payload)
	{

        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json; charset=utf-8'
        ];
        $options = [
            'form_params' => $payload
        ];
        $apiRequest = new GuzzleRequest($method, $url, $headers);
        $result = $client->sendAsync($apiRequest, $options)->wait();
        return json_decode($result->getBody());
    }

}
?>
