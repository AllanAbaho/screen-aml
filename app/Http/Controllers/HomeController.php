<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Mime\Encoder\Base64Encoder;

class HomeController extends Controller
{
    public function show()
    {
        return view('home');
    }

    public function getAccessToken($category)
    {
        $ursbToken = 'M0M1T2h6NU13ZDhBMmZ1al91X3FqRUF6RmwwYToySV9Lc21wcVBSNk9zaUlLbFRMc01INlk1a2th';
        $niraToken = 'TVpSNmxSR092aVpWN0FSREtPNFdmdE9TV21NYTptdjlXVTJCcHIxbVIxWUNvVWJsQ2p3MGJJb2th';
        if ($category == 'NIRA') {
            $token = $niraToken;
        } else {
            $token = $ursbToken;
        }
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
                'Authorization: Basic ' . $token,
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
        Log::info(['Nita Bearer Response', $response]);
        $json = json_decode($response, true);
        Log::info(['Json Response', $json]);

        return $json['access_token'];
    }

    public function getPerson($nin)
    {
        try {
            $username = env('NITA_USERNAME');


            $nonce_bytes = $this->generatenonce_asbytes();
            $nonce = base64_encode($nonce_bytes);

            $timestamp = $this->create_timestamp();
            $created_digest = $this->timestamp_fordigest($timestamp);
            $created_digest_bytes = $this->gettimestamp_asbytes($created_digest);

            $passwordhash_bytes = $this->hashpassword_withdigest();

            $password_digest = $this->getPasswordDigest($nonce_bytes, $created_digest_bytes, $passwordhash_bytes);

            $created_request = $this->timestamp_forrequest($timestamp);

            $access = $this->getAccessToken('NIRA');
            $curl = curl_init();
            $baseUrl = 'https://api-uat.integration.go.ug/';
            $niraUrl = 't/nira.go.ug/nira-api/1.0.0/';
            $url = $baseUrl . $niraUrl . 'getPerson?nationalId=' . $nin;
            $headers = array(
                'Authorization: Bearer ' . $access,
                'nira-auth-forward: ' . base64_encode($username . ':' . $password_digest),
                'nira-nonce: ' . $nonce,
                'nira-created: ' . $created_request
            );
            Log::info('API Url', [$url, $headers]);

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_SSL_VERIFYHOST => FALSE,
                CURLOPT_SSL_VERIFYPEER => FALSE,
                CURLOPT_HTTPHEADER => $headers,
            ));

            $response = curl_exec($curl);
            Log::info('Nira Response', [$response]);

            curl_close($curl);
            // $xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);
            // $json = json_encode($xml);
            $array = json_decode($response, true);

            Log::info('Returned Array', [$array]);

            return $array;
        } catch (Exception $e) {
            Log::info('An error occured', [$e->getMessage()]);
            return $e->getMessage();
        }
    }

    public function getBusiness($brn)
    {
        try {
            $username = env('NITA_USERNAME');


            $nonce_bytes = $this->generatenonce_asbytes();
            $nonce = base64_encode($nonce_bytes);

            $timestamp = $this->create_timestamp();
            $created_digest = $this->timestamp_fordigest($timestamp);
            $created_digest_bytes = $this->gettimestamp_asbytes($created_digest);

            $passwordhash_bytes = $this->hashpassword_withdigest();

            $password_digest = $this->getPasswordDigest($nonce_bytes, $created_digest_bytes, $passwordhash_bytes);

            $created_request = $this->timestamp_forrequest($timestamp);

            $access = $this->getAccessToken('URSB');
            $curl = curl_init();
            $baseUrl = 'https://api-uat.integration.go.ug/';
            $niraUrl = 't/ursb.go.ug/ursb-brs-api/1.0.0/';
            $url = $baseUrl . $niraUrl . 'entity/get_entity_full/' . $brn . '/-/APS-NITA';
            $headers = array(
                'Authorization: Bearer ' . $access,
                'nira-auth-forward: ' . base64_encode($username . ':' . $password_digest),
                'nira-nonce: ' . $nonce,
                'nira-created: ' . $created_request
            );
            Log::info('API Url', [$url, $headers]);
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_SSL_VERIFYHOST => FALSE,
                CURLOPT_SSL_VERIFYPEER => FALSE,
                CURLOPT_HTTPHEADER => $headers,
            ));

            $response = curl_exec($curl);
            Log::info('Nira Response', [$response]);

            curl_close($curl);
            // $xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);
            // $json = json_encode($xml);
            $array = json_decode($response, true);

            Log::info('Returned Array', [$array]);

            return $array;
        } catch (Exception $e) {
            Log::info('An error occured', [$e->getMessage()]);
            return $e->getMessage();
        }
    }

    public function generatenonce_asbytes()
    {
        return random_bytes(16);
    }

    public function create_requesttimestamp()
    {
        $utc_now = new \DateTime('now', new \DateTimeZone('UTC'));
        $eat_timezone = new \DateTimeZone('Africa/Kampala');
        $eat_now = $utc_now->setTimezone($eat_timezone);
        $eat_time = $eat_now->format('Y-m-d\TH:i:s');

        return $eat_time . '+03:00';
    }

    public function create_timestamp()
    {
        $utc_now = new \DateTime('now', new \DateTimeZone('UTC'));
        $eat_timezone = new \DateTimeZone('Africa/Kampala');
        $eat_now = $utc_now->setTimezone($eat_timezone);
        $eat_time = $eat_now->format('Y-m-d\TH:i:s.v0');

        return $eat_time;
    }

    public function timestamp_forrequest($timestamp)
    {
        return substr($timestamp, 0, -1) . '+03:00';
    }

    public function timestamp_fordigest($timestamp)
    {
        return substr($timestamp, 0, -1) . '+0300';
    }

    public function gettimestamp_asbytes($timestamp)
    {
        return mb_convert_encoding($timestamp, 'UTF-8');
        // return utf8_encode($timestamp);
    }

    public function hashpassword_withdigest()
    {
        return sha1(mb_convert_encoding(env('NITA_PASSWORD'), 'UTF-8'), true);
    }

    function getPasswordDigest($nonce, $created, $password_hash)
    {
        $combined_bytearray = $nonce . $created . $password_hash;

        $encoded_digest = sha1($combined_bytearray, true);
        $password_digest = base64_encode($encoded_digest);

        return mb_convert_encoding($password_digest, 'ISO-8859-1');
        // return utf8_decode($password_digest);
    }

    public function getAuthBearer()
    {
        $username = env('NITA_USERNAME');


        $nonce_bytes = $this->generatenonce_asbytes();
        $nonce = base64_encode($nonce_bytes);

        $timestamp = $this->create_timestamp();
        $created_digest = $this->timestamp_fordigest($timestamp);
        $created_digest_bytes = $this->gettimestamp_asbytes($created_digest);

        $passwordhash_bytes = $this->hashpassword_withdigest();

        $password_digest = $this->getPasswordDigest($nonce_bytes, $created_digest_bytes, $passwordhash_bytes);

        $created_request = $this->timestamp_forrequest($timestamp);

        dd([$username, $password_digest,  $nonce, $created_request]);
    }
}
