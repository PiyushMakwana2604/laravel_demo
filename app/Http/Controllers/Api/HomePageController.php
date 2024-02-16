<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\store;
use App\Models\banner;
use App\Models\category;
use App\Models\Products;
use App\Models\product_image;
use App\Models\address;
use App\Models\cart;
use App\Models\product_review;
use App\Helpers\ApiHelper;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function product_search(Request $request){
        $products = Products::all();
        $this->validate($request,[
            'search' => 'nullable',
        ]);
        if(!empty($request->search)){
            $products = Products::where('product_name','LIKE','%'.$request->search.'%')->get();
        }
        return $this->toJson([$products], trans('Success'), 1);
    }

    public function banner(Request $request){
        $banner = banner::all();
        if(empty($banner)){
            return $this->toJsonEnc([],trans('api.home.something_wrong'),0);
        }
        return $this->toJsonEnc($banner,trans('api.home.succ_get_banner_data'),1);
    }

    public function store_listing(Request $request){
        $store = store::selectRaw('tbl_store.id,shipping_id,shipping_id,image,description,rating,rating')
        ->where('is_active',1)
        ->orderBy('id','desc')
        ->paginate(5)
        ->toArray();   

        if(empty($store)){
            return $this->toJsonEnc([],trans('api.home.something_wrong'),0);
        }
        return $this->toJson($store,trans('api.home.succ_get_store_data'),1);
    }

    public function store_details(Request $request){
        $user = \Auth::guard('api')->user();
          $this->validate($request, [
            'id' => "required",
        ]);
    
         $store_detail = store::where('id', $request->id)
            ->with([
                'Products' => function ($query) {
                    $query->selectRaw('tbl_product.id,store_id,product_name')
                        ->where("tbl_product.store_id",1);
                }
            ])
            ->with([
                'productImage' => function ($query) {
                    $query->select('tbl_product_images.id', 'product_id', 'product_image', )
                        ->where("product_id", "=", "1");
                }
            ])
            ->first();
    
        if(!empty($store_detail)){
              return $this->toJson([$store_detail, 'Success', 1]);
        }else{
            return $this->toJsonEnc(['', 'Failed', 0]);

        }
    }

    public function top_deals(Request $request){

        $user = \Auth::guard('api')->user();

        $top_deals =  Products::selectRaw('tbl_product.id,store_id,product_name,price,discount_type,discount_value,is_like')
        ->where('tbl_product.is_active', 1);
        if(!empty($user)){
            $top_deals = $top_deals->leftJoin('tbl_wishlist', function($join) use($user) {
            $join->on('tbl_wishlist.product_id', '=', 'tbl_product.id')
                 ->where('tbl_wishlist.user_id', '=', $user->id); 
            })
            ->with([
                'productImages' => function($query){
                    $query->selectRaw('tbl_product_images.id,product_id,product_image');
                    // ->orderBy('id','desc')->limit(1);
                }
            ]);
        }
        $top_deals = $top_deals->orderBy('id','desc')
        ->paginate(5)
        ->toArray(); 
        if(empty($top_deals)){
            return $this->toJsonEnc([],trans('api.home.something_wrong'),0);
        }  
        $hasMany = !empty($top_deals['next_page_url']) ? 1 : 0;
        $top_deals = collect($top_deals['data']);
        return $this->toJson(['top_Deals' => $top_deals,'hasMany' => $hasMany],trans('api.home.succ_get_data'),1);
    }

    public function new_arrivals(Request $request){
        $user = \Auth::guard('api')->user();

        $this->validate($request,[
            'category_id' => 'required',
        ]);
        $new_arrivals =  Products::selectRaw('tbl_product.id,store_id,product_name,price,discount_type,discount_value,is_like')
        ->where('tbl_product.is_active', 1)
        ->where('tbl_product.category_id', $request->category_id)
        ->leftJoin('tbl_wishlist', function($join) use($user) {
            $join->on('tbl_wishlist.product_id', '=', 'tbl_product.id')
                 ->where('tbl_wishlist.user_id', '=', $user->id); 
            })
        ->with([
            'productImages' => function($query){
                $query->selectRaw('tbl_product_images.id,product_id,product_image');
            }
        ])
        ->orderBy('id','desc')
        ->paginate(5)
        ->toArray(); 
        return $this->toJson(['new_arrivals' => $new_arrivals['data']],trans('api.home.succ_get_data'),1);
    }

    public function product_details(Request $request){
        
        $this->validate($request,[
            'product_id' => 'required',
        ]);

        $productDeatils = ApiHelper::getProductDeatils($request)->get();

        if(empty($productDeatils)){
            return $this->toJson([],trans('api.home.something_wrong'),0);
        }
        return $this->toJson([$productDeatils], trans('Success'), 1);

    }

    public function product_list(Request $request){

        $this->validate($request,[
            'min_price' => 'nullable',
            'max_price' => 'nullable',
            'category_id' => 'nullable',
            'store_rating' => 'nullable',
            'is_discount' => 'nullable',
        ]);

        $productList = ApiHelper::productList($request);

        if(!empty($request->max_price) && !empty($request->min_price)){
            $productList= $productList->where('tbl_product.price','>',$request->min_price)
                ->where('tbl_product.price','<',$request->max_price);
        }

        if(!empty($request->category_id)){
            $productList= $productList->where('tbl_product.category_id',$request->category_id);
        }

        if(!empty($request->store_rating)){
            $productList= $productList->where('tbl_product.rating',$request->store_rating);
        }

        if(!empty($request->is_discount)){
            $productList= $productList->where('tbl_product.discount_value','>',0);
        }
        
        $productList = $productList->get();
       
        if(empty($productList)){
            return $this->toJson([],trans('api.home.something_wrong'),0);
        }
        return $this->toJson([$productList], trans('Success'), 1);
    }

    public function add_address(Request $request){

        $user = \Auth::guard('api')->user();

        $this->validate($request, [
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'name' => 'required',
            'company' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $data = [
            'user_id' => $user->id,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'name' => $request->name,
            'company' => $request->company,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ];

        $add_address = address::create($data);
        if (!$add_address) {
            return $this->toJson([],trans('api.home.something_wrong'),0);
        }
        return $this->toJson([$add_address], trans('Success'), 1);
    }

    public function edit_address(Request $request){
        $this->validate($request, [
            'address_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'name' => 'required',
            'company' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        $edit_address = address::find($request->address_id);
        if(empty($edit_address)){
            return $this->toJson([],trans('api.home.something_wrong'),0);
        }
        $edit_address->fill($request->all());
        $edit_address->save();
        return $this->toJson([$edit_address], trans('Success'), 1);
    }

    public function delete_address(Request $request){
        $this->validate($request, [
            'address_id' => 'required'
        ]);

        $delete_address = address::where('id',$request->address_id)->delete();
        if(empty($delete_address)){
            return $this->toJson([],trans('api.home.something_wrong'),0);
        }
        return $this->toJson([$delete_address], trans('Success'), 1);
    }

    public function edit_user(Request $request){    
        $user = \Auth::guard('api')->user();
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'profile_image' => 'required',
            'email' => 'required',
            'country_code' => 'required',
            'phone' => 'required'
        ]);
        $edit_user = User::find($user->id);

        if(empty($edit_user)){
            return $this->toJson([],trans('api.home.something_wrong'),0);
        }

        $edit_user->fill($request->all());
        $edit_user->save();

        return $this->toJson([$edit_user], trans('Success'), 1);
    }

    public function add_cart(Request $request){
        $user = \Auth::guard('api')->user();
         $this->validate($request, [
            'product_id' => 'required',
            'size' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'comments' => 'nullable',
            'charge' => 'required',
            'tax' => 'required',
            'total_amount' => 'required'
        ]);
        $data = [
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'size' => $request->size,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'comments' => !empty($request->comments) ? $request->comments : "",
            'charge' => $request->charge,
            'tax' => $request->tax,
            'total_amount' => $request->total_amount
        ];

        $add_cart = cart::create($data);
        if (!$add_cart) {
            return $this->toJson([],trans('api.home.something_wrong'),0);
        }
        return $this->toJson([$add_cart], trans('Success'), 1);
    }

    public function cart_details(Request $request){
        $user = \Auth::guard('api')->user();
        $cart_details = cart::selectRaw('tbl_cart.*,tbl_user.first_name,tbl_user.last_name,tbl_product_images.product_image')
        ->where('user_id',$user->id)
        ->join('tbl_user', 'tbl_cart.user_id', '=', 'tbl_user.id')
        ->join('tbl_product_images', function ($query){
            $query->on('tbl_cart.product_id', 'tbl_product_images.product_id');
        })
        ->get();
        if(empty($cart_details)){
            return $this->toJson([],trans('api.home.something_wrong'),0);
        }
        return $this->toJson([$cart_details], trans('Success'), 1);
    }

    public function add_product_review(Request $request){
        $user = \Auth::guard('api')->user();
        $this->validate($request, [
            'product_id' => 'required',
            'rating' => 'required',
            'review' => 'nullable'
        ]);

        $data = [
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'review' => $request->review
        ];
        $product_review = product_review::create($data);
        if (!$product_review) {
            return $this->toJson([],trans('api.home.something_wrong'),0);
        }
        return $this->toJson([$product_review], trans('Success'), 1);
    }

    public function product_review_list(Request $request){
        $this->validate($request, [
            'product_id' => 'required'
        ]);
        $product_review = product_review::selectRaw('tbl_product_review.*,tbl_product.product_name,tbl_product.rating as product_rating,tbl_product.review_count,tbl_user.first_name,tbl_user.last_name ')
            ->where('tbl_product_review.product_id',$request->product_id)
            // ->groupBy('product_images_id')
            ->join('tbl_product',function($join){
                $join->on('tbl_product_review.product_id','tbl_product.id');
            })
            ->with([
                'productImage' => function ($query) {
                    $query->select('tbl_product_images.id', 'tbl_product_images.product_id', 'tbl_product_images.product_image', )
                        ->where("product_id", "=", "1");
                }
            ])
            // ->join('tbl_product_images',function($join){
            //     $join->on('tbl_product.id','tbl_product_images.product_id');
            // })
            // ->selectRaw('tbl_product_images.id as product_images_id,tbl_product_images.product_image')
            ->join('tbl_user',function($join){
                $join->on('tbl_product_review.user_id','tbl_user.id');
            })
            ->get();
        if (!$product_review) {
            return $this->toJson([],trans('api.home.something_wrong'),0);
        }
        return $this->toJson([$product_review], trans('Success'), 1);
    }
}

