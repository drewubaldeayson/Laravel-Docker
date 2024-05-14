<?php

namespace App\Libraries;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Facades\Config;
use App\Helpers\StringHelper;

class PayTech
{

	private $url;
	private $uri;
	private $token = "";
	private $form_data;
	private $response;

	public function __construct() {
        $this->url = "https://ptechresttest.qoneqtor.com";
        $this->uri = new Uri($this->url);
        $this->token = "RH1VVWF0SYUZ0YJUB";
    }

    public function setFormData(array $data)
    {
    	$this->form_data = json_encode($data);
    }

    public function getFormData()
    {
    	return $this->form_data;
    }

    public function pay()
    {
    	$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $this->url.'/api/v1/payment/paynow',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => $this->form_data,
		  CURLOPT_HTTPHEADER => array(
		    'e-token: '.$this->token,
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);

		$this->setResponse($response);
    }

    public function getPaymentMethods()
    {
        $curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $this->url.'/api/v1/payment/methods',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'e-token: '.$this->token,
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$this->setResponse($response);
    }

    public function setResponse($data)
    {
    	$this->response = json_decode($data);
    }

    public function getResponse()
    {
    	return $this->response;
    }



}