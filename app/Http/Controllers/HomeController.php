<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function show()
    {
        return view('home');
    }

    public function getAccessToken()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-uat.integration.go.ug/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYHOST => FALSE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic M0M1T2h6NU13ZDhBMmZ1al91X3FqRUF6RmwwYToySV9Lc21wcVBSNk9zaUlLbFRMc01INlk1a2th',
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            Log::info('Search Curl Error', [$error_msg]);
            return response(['status' => 'failure', 'message' => $error_msg]);
        }
        curl_close($curl);
        $json = json_decode($response, true);

        return $json['access_token'];
    }

    public function getPerson($nin)
    {
        try {
            $access = $this->getAccessToken();
            $curl = curl_init();
            $baseUrl = 'https://api-uat.integration.go.ug/';
            $niraUrl = 't/nira.go.ug/nira-api/1.0.0/';
            curl_setopt_array($curl, array(
                CURLOPT_URL => $baseUrl . $niraUrl . 'getPerson?nationalId=' . $nin,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_SSL_VERIFYHOST => FALSE,
                CURLOPT_SSL_VERIFYPEER => FALSE,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $access
                ),
            ));

            $response = curl_exec($curl);
            Log::info('Nira Response', [$response]);

            curl_close($curl);
            $xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);

            Log::info('Returned Array', [$array]);

            return $array;
        } catch (Exception $e) {
            Log::info('An error occured', [$e->getMessage()]);
            return $e->getMessage();
        }
    }
}
