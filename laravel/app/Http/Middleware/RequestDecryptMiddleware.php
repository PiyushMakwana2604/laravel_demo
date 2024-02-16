<?php

namespace App\Http\Middleware;
use App\Helpers\CommonHelper;

use Closure;
use Illuminate\Http\Request;

class RequestDecryptMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $req = CommonHelper::requestDecrypt($request->getContent());
        if(!empty($req)){
            $reqArray = [];
            foreach($req->all() as $key => $i){
                $reqArray[$key] = $i;
            }
            $request->replace($reqArray);
        }
        // dd($request->all());
        $lang = $request->header('Accept-Language');
        
        if(!empty($lang))
        {
            if(in_array($lang, ['en', 'de','fr'])){
    
                app()->setLocale($lang);
            }
            else{
                return response()->json(CommonHelper::bodyEncrypt(json_encode([
                    'code' => 400,
                    'message' => trans('api.language_not_found'),
                    'data' => new stdClass()
                ])),200);    
            }
        }
        else{
            return response()->json(CommonHelper::bodyEncrypt(json_encode([
                'code' => 400,
                'message' => trans('api.language_not_found'),
                'data' => new stdClass()
            ])),200);
        }
        return $next($request);
    }
}
