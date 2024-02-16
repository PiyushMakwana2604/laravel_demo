<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\CommonHelper;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function toJsonEnc($result = [], $message = '', $status = 1)
    {
        return response()->json(CommonHelper::bodyencrypt(json_encode([
            'code' => $status,
            'data' => !empty($result)? $result : new \stdClass(),
            'message' => $message,
        ])));
    }

    public function toJson($result = [], $message = '', $status = 1)
    {
        return response()->json([
            'code' => $status,
            'data' => !empty($result)? $result : new \stdClass(),
            'message' => $message,
        ]);
    }

    public function encryptIndex(){
        return view('encrypt');
    }
    
    public function changeEncDecData(Request $request){
        if($request->type == "encrypt"){
            $data["decrypt_value"] = $request->data;
            $data["encrypt_value"] = CommonHelper::bodyencrypt($request->data);
        }
        else{
            $data["decrypt_value"] = json_encode(CommonHelper::bodyDecrypt($request->data));
            $data["encrypt_value"] = $request->data;
        }
        return view('encrypt',$data);
    }
}
