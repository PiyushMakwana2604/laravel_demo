<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\Products;
use App\Models\category;
use App\Models\cart;
use DateTime;
use DateTimeZone;
use stdClass;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ApiHelper{

    /**--------------------------------------------------
     * CommonHelper - Helper
     * --------------------------------------------------
     * 
     * This helper is used for API related common methods.
     * In this helper common methods are written, that is used at multiple locations.
     * 
     */

    public static function getProductDeatils($request){

        $user = \Auth::guard('api')->user();
       
        $productDeatils = Products::where('tbl_product.id',$request->product_id)
        ->selectRaw('tbl_product.*,tbl_categories.category_name,tbl_categories.image,is_like')
            ->leftJoin('tbl_categories', function($join){
                $join->on('tbl_categories.id', '=', 'tbl_product.category_id');
            });

        if(!empty($user)){
            $productDeatils = $productDeatils->selectRaw('IFNULL(tbl_wishlist.is_like,0)as is_like')
            ->leftJoin('tbl_wishlist', function($join) use($user) {
            $join->on('tbl_wishlist.product_id', '=', 'tbl_product.id')
                 ->where('tbl_wishlist.user_id', '=', $user->id); 
            });
        }
        $productDeatils = $productDeatils->with([
            'productImages' => function($query){
                $query->selectRaw('tbl_product_images.id,product_id,product_image');
            }
        ]);

        $productDeatils = $productDeatils
        ->selectRaw('tbl_store.name as store_name,tbl_store.image as store_image ,tbl_store.description as store_description ,tbl_store.rating as store_rating,tbl_store.review as store_review')
        ->leftJoin('tbl_store',function($join){
            $join->on('tbl_product.store_id','=','tbl_store.id');
        });

        // dd($productDeatils);
        return $productDeatils;
    }   

    public static function productList($request){
        $productDeatils = Products::where('tbl_product.is_active',1);
        return $productDeatils;
    }

    public static function getCartDeatils(Request $request){
        $user_id = $request->user()->id;
        $cart_count = cart::where('user_id',$user_id)->count();

        $cart = \DB::table('tbl_cart')
            ->where("tbl_cart.user_id",$user_id)
            ->join('tbl_product', 'tbl_cart.product_id','=','tbl_product.id' )
            ->join('tbl_product_images', 'tbl_product.id', '=', 'tbl_product_images.product_id')
            ->select('tbl_cart.*','tbl_product.product_name', 'tbl_product_images.product_image')
            ->get();
        $data = [
            'cart' => $cart,
            'cart_count' => $cart_count
        ];
        return $data;
    }
}