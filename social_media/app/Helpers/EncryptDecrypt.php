<?php
namespace App\Helpers;

use App\Model\User;
use DateTime;
use DateTimeZone;
use stdClass;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EncryptDecrypt
{

    /**--------------------------------------------------
     * CommonHelper - Helper
     * --------------------------------------------------
     * 
     * This helper is used for API related common methods.
     * In this helper common methods are written, that is used at multiple locations.
     * 
     */



     /**
     * This method is used for encrypt string.
     * 
     * @param string $string
     * 
     * @return string encrypted string.
     */

     public static function bodyEncrypt($string)
     {
        
        $encryptionMethod = "AES-256-CBC";
        $secret = hash('sha256', config('constant.SECRET')); // must be 32 character in length.
        
        // dd($secret);

        $iv=config('constant.IV');
        $encryptValue = openssl_encrypt($string, $encryptionMethod, $secret, 0 , $iv);
        
        return $encryptValue;
     }


     /**
     * This method is used for decrypt string.
     * 
     * @param string $string
     * 
     * @return string decrypted string.
     */

     public static function bodyDecrypt($string)
     {
        
        $encryptionMethod = "AES-256-CBC";
        $secret = hash('sha256', config('constant.SECRET')); // must be 32 character in length.
        $iv=config('constant.IV');

        $decryptValue = openssl_decrypt($string, $encryptionMethod, $secret, 0, $iv);
        
        return $decryptValue;
     }

     public static function requestDecrypt($request)
     {
        $data = (array)json_decode(EncryptDecrypt::bodyDecrypt($request));

        return new Request($data);
        
     }


     
}
