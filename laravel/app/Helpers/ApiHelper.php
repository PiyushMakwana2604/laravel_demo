<?php
namespace App\Helpers;

use App\Model\User;
use DateTime;
use DateTimeZone;
use stdClass;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Helpers\EncryptDecrypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ApiHelper{
    
     public static function apicall($url,$method,$postdata){
        
        $token = Session::has('user') ? EncryptDecrypt::bodyencrypt(Session::get('user')->token) : "";


        $url = "http://localhost:3000/api/v1/" . $url;

        // dd($token);

        $header = array(
            // Set here requred headers
            'api-key:uqLBHBCvzUTdDR0m000BYw==',
            'Content-Type: text/plain',
            'token:' . $token . ''
            
        );

        // dd($postdata);

        $encode = json_encode($postdata);

        // dd($encode);

        $data = EncryptDecrypt::bodyEncrypt($encode);

        // dd($data);
        // dd($url, $data, $method, $header);
        $api = ApiHelper::api($url, $data, $method, $header);

        // dd($api);

        $decrypt = EncryptDecrypt::bodyDecrypt($api);

        // dd($decrypt);
        
        $response = json_decode($decrypt);
        // dd($response);
        return $response;

    }

    /**
     * Fucntion to api From Node
     */

    public static function api($url, $data, $method, $header)
    {
        try{
            // dd($header);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_POSTFIELDS =>$data,
                CURLOPT_HTTPHEADER =>$header
            ));
            $response = curl_exec($curl);
            // dd($response)
            // dd(json_decode($response));
            $url = '{POST_REST_ENDPOINT}';
            // return json_decode($response);
            return $response;
        } catch(Exception $e){
            dd($e);
        }

    }
}