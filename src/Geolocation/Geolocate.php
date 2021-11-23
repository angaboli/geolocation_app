<?php

namespace App\Geolocation;

use GuzzleHttp\Client;
use PHPUnit\Util\Exception;

class Geolocate{

    const ACCESS_KEY = "59d1a904b6859f005fc78f18fca29eb1";
    private $ip_address;

    public function __construct(){
        $this->ip_address = '176.179.131.91';
    }
    // get user's IP address
    function getUserIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    function getIPCoordinate(){
        try {
            $client = new Client([
                // Base URI is used with relative requests
                "base_uri" => "http://api.ipapi.com",
            ]);

            $response = $client->request("GET", "/$this->ip_address", [
                "query" => [
                    "access_key" => self::ACCESS_KEY,
                ]
            ]);

            //get status code using $response->getStatusCode();

            $body = $response->getBody();
            $arr_result = json_decode($body, true);
            //print_r($arr_result);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        return $arr_result;
    }

}
