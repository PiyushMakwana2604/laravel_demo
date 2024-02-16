<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\cart;
use App\Models\tbl_otp;
use App\Models\Userdevice;
use App\Models\category;
use App\Models\Products;
use App\Models\address;
use App\Models\product_image;
use App\Models\order;
use App\Models\order_details;
use Illuminate\Support\Facades\Cookie;
use App\Helpers\ApiHelper;
use Artisan;
use Auth;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    //
    public function home(Request $request){
        if (!auth()->user()) {
            return redirect(route('website.login'));
        } else {
            $cartDetails = ApiHelper::getCartDeatils($request);
            $cart = $cartDetails['cart'];
            $cart_count = $cartDetails['cart_count'];
            $category = category::all();
            // echo "<pre>";
            // print_r($category);die;
            $data = [
                "category" =>$category
            ];
            return view('website.product.home',compact('data','cart','cart_count'));
        }
    }
    
    public function about(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $cartDetails = ApiHelper::getCartDeatils($request);
        $cart = $cartDetails['cart'];
        $cart_count = $cartDetails['cart_count'];
        return view('website.product.about',compact('cart','cart_count'));
    }

    public function product_list(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $user_id = $request->user()->id;
        $product = \DB::table('tbl_product')
        ->where('is_active',1)
        ->join('tbl_product_images', 'tbl_product.id', '=', 'tbl_product_images.product_id')
        ->select('tbl_product.*', 'tbl_product_images.product_image')
        ->paginate(6);
        $total_count = Products::where('is_active',1)->count();
        $mens_count = Products::where('category_id', 1)->where('is_active',1)->count();
        $womens_count = Products::where('category_id', 2)->where('is_active',1)->count();
        $kids_count = Products::where('category_id', 3)->where('is_active',1)->count();
        $count = [
            "total_count" => $total_count,
            "mens_count" => $mens_count,
            "womens_count" => $womens_count,
            "kids_count" => $kids_count
        ];

        $cartDetails = ApiHelper::getCartDeatils($request);
        $cart = $cartDetails['cart'];
        $cart_count = $cartDetails['cart_count'];
        return view('website.product.product_list',compact('product','count','cart','cart_count'));
    }

    public function product_sorting(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        if($request->sorting_type == "price-low-to-high"){
        $data = \DB::table('tbl_product')
            ->where('is_active',1)
            ->join('tbl_product_images', 'tbl_product.id', '=', 'tbl_product_images.product_id')
            ->select('tbl_product.*', 'tbl_product_images.product_image')
            ->orderBy('tbl_product.price', 'asc')
            ->paginate(6);
            return $data;
        } 
        else if($request->sorting_type == "price-high-to-low"){
        $data = \DB::table('tbl_product')
            ->where('is_active',1)
            ->join('tbl_product_images', 'tbl_product.id', '=', 'tbl_product_images.product_id')
            ->select('tbl_product.*', 'tbl_product_images.product_image')
            ->orderBy('tbl_product.price', 'desc')
            ->paginate(6);
            return $data;    
        }
        else if($request->sorting_type == "rating-low-to-high"){
        $data = \DB::table('tbl_product')
            ->where('is_active',1)
            ->join('tbl_product_images', 'tbl_product.id', '=', 'tbl_product_images.product_id')
            ->select('tbl_product.*', 'tbl_product_images.product_image')
            ->orderBy('tbl_product.rating', 'asc')
            ->paginate(6);
            return $data;
        }
        else if($request->sorting_type == "rating-high-to-low"){
        $data = \DB::table('tbl_product')
            ->where('is_active',1)
            ->join('tbl_product_images', 'tbl_product.id', '=', 'tbl_product_images.product_id')
            ->select('tbl_product.*',   'tbl_product_images.product_image')
            ->orderBy('tbl_product.rating', 'desc')
            ->paginate(6);
            return $data;    
        }
        else{
        $data = \DB::table('tbl_product')
            ->where('is_active',1)
            ->join('tbl_product_images', 'tbl_product.id', '=', 'tbl_product_images.product_id')
            ->select('tbl_product.*',   'tbl_product_images.product_image')
            ->paginate(6);
            return $data;   
        }
        
    }
    public function product_filter(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $data = \DB::table('tbl_product')
            ->where('tbl_product.is_active',1)
            ->where('tbl_product.price','>=',$request['filter']['priceFirstValue'])
            ->where('tbl_product.price','<=',$request['filter']['priceSecondValue']);
        if($request['filter']['category_id'] > 0){
            $data = $data->where('tbl_product.category_id',$request['filter']['category_id']);
        }
        if (isset($request['filter']['brand']) && !empty($request['filter']['brand'])) {
            dd($request['filter']['brand']);
        } 
        if (isset($request['filter']['rating']) && !empty($request['filter']['rating'])) {
            $data = $data->where('tbl_product.rating','<=',$request['filter']['rating']);
        } 
        if($request['filter']['is_discount'] != 0){
            $data = $data->where('tbl_product.discount_value','>','0');
        }
        $data = $data->join('tbl_product_images', 'tbl_product.id', '=', 'tbl_product_images.product_id')
            ->select('tbl_product.*',   'tbl_product_images.product_image')
            ->paginate(6);
        return $data;
    }

    public function manage_products_seller(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $data = \DB::table('tbl_product')
            ->where('is_active',1)
            ->join('tbl_product_images', 'tbl_product.id', '=', 'tbl_product_images.product_id')
            ->select('tbl_product.*',   'tbl_product_images.product_image')
            ->get();
        $cartDetails = ApiHelper::getCartDeatils($request);
        $cart = $cartDetails['cart'];
        $cart_count = $cartDetails['cart_count'];
        return view('website.product.manage-products-seller',compact('data','cart','cart_count'));
    }
    public function manage_products_post(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $data = \DB::table('tbl_product')
            ->where('tbl_product.is_active',1);

        if($request->category_id == 1){
            $data = $data->where('tbl_product.category_id',$request->category_id);            
        }else if($request->category_id == 2){
            $data = $data->where('tbl_product.category_id',$request->category_id);            
        }else if($request->category_id == 3){
            $data = $data->where('tbl_product.category_id',$request->category_id);            
        }

        $data = $data->join('tbl_product_images', 'tbl_product.id', '=', 'tbl_product_images.product_id')
            ->select('tbl_product.*',   'tbl_product_images.product_image')
            ->get();
        return $data;
    }
    public function product_details(Request $request,$product_id){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $product = \DB::table('tbl_product')
            ->where('tbl_product.is_active',1)
            ->where('tbl_product.id',$product_id)
            ->join('tbl_product_images', 'tbl_product.id', '=', 'tbl_product_images.product_id')
            ->join('tbl_store', 'tbl_product.store_id', '=', 'tbl_store.id')
            ->select('tbl_product.*',   'tbl_product_images.product_image','tbl_store.image as store_image','tbl_store.name as store_name','tbl_store.description as store_description')
            ->get();
        $related_products = \DB::table('tbl_product')
            ->where('tbl_product.is_active',1)
            ->where('tbl_product.category_id',$product[0]->category_id)
            ->where('tbl_product.id','!=',$product_id)
            ->join('tbl_product_images', 'tbl_product.id', '=', 'tbl_product_images.product_id')
             ->select('tbl_product.*',   'tbl_product_images.product_image')
            ->get();
        $data = [
            "product" => $product[0],
            "related_products" => $related_products
        ];
        return view('website.product.product-details',compact('data'));
    }
    public function add_cart(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $user_id = $request->user()->id;
        $is_cart = \DB::table('tbl_cart')
            ->where('user_id',$user_id)
            ->where('size',(isset($request->selected_size) && $request->selected_size != null) ? $request->selected_size : "56")
            ->where('product_id',$request->product_id)
            ->get();

            // dd($is_cart);
        $product = \DB::table('tbl_product')
            ->where('is_active',1)
            ->where('id',$request->product_id)
            ->get();
        $data = [
            "user_id" => $user_id,
            "product_id" => $request->product_id,
            "size" => (isset($request->selected_size) && $request->selected_size != null) ? $request->selected_size : "56",
            "comments" => "",
            "charge" => 10,
            "tax" => 10,
            "price" => $product[0]->price,
            "total_amount" => $product[0]->price + 10 + 10
        ];
        // dd($data);
        if(isset($is_cart[0]->id) && $is_cart[0]->id !== null){
            $cart = \DB::table('tbl_cart')
                ->where('id', $is_cart[0]->id)
                ->increment('quantity', intval((isset($request->quantity_value) && $request->quantity_value != null) ? $request->quantity_value : 1));
        }else{
            $data["quantity"] = (isset($request->quantity_value) && $request->quantity_value != null) ? $request->quantity_value : 1;
            $cart = cart::create($data);
        }
        if ($cart) {
            $cartDetails = ApiHelper::getCartDeatils($request);
            return $cartDetails;
        } else{
            return false;
        }
    }
    public function cart(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $cartDetails = ApiHelper::getCartDeatils($request);
        $cart = $cartDetails['cart'];
        $cart_count = $cartDetails['cart_count'];
        return view('website.product.cart',compact('cart','cart_count'));
    }  
    public function update_cart_quantity(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $this->validate($request,[
            'cart_id' => 'required',
            'new_quantity' => 'required'
        ]);
        $update_cart = cart::where('id', $request['cart_id'])->update(['quantity' => $request['new_quantity']]);
        if($update_cart){
            $cartDetails = ApiHelper::getCartDeatils($request);
            return $cartDetails;
        }else{
            return false;
        }
    }
    public function delete_cart(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $this->validate($request,[
            'cart_id' => 'required'
        ]);
        $cart = Cart::find($request['cart_id']);
        if ($cart) {
            $cart->delete();
            $cartDetails = ApiHelper::getCartDeatils($request);
            return $cartDetails;
        } else {
            return false;
        }
    }
    public function select_address(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $user_id = $request->user()->id;
        $cartDetails = ApiHelper::getCartDeatils($request);
        $cart = $cartDetails['cart'];
        $cart_count = $cartDetails['cart_count'];
        $address = address::where('user_id',$user_id)->get();
        return view('website.product.select-address',compact('cart','cart_count','address'));
    }
    public function order_summary(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $cartDetails = ApiHelper::getCartDeatils($request);
        $cart = $cartDetails['cart'];
        $cart_count = $cartDetails['cart_count'];
        return view('website.product.order-summary',compact('cart','cart_count'));
    }
    public function select_payment(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $cartDetails = ApiHelper::getCartDeatils($request);
        $cart = $cartDetails['cart'];
        $cart_count = $cartDetails['cart_count'];
        return view('website.product.select-payment',compact('cart','cart_count'));
    }
    public function add_order(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $order_no = Str::random(18);
        $order_date = Carbon::today()->format('Y-m-d');
        $transaction_id = Str::random(20);
        $user_id = $request->user()->id;
        $cartDetails = ApiHelper::getCartDeatils($request);
        $totalPrice = 0.0;
        $totalTax = 0.0;
        foreach ($cartDetails['cart'] as $item) {
            $totalPrice += $item->price*$item->quantity;
            $totalTax += $item->charge + $item->tax;
        }
        $grand_total = $totalPrice + $totalTax;
        $order = [
            "user_id" => $user_id,
            "address_id" => 1,
            "coupan_id" => 1,
            "order_no" => $order_no,
            "order_date" => $order_date,
            "order_status" => "pending",
            "transaction_id" => $transaction_id,
            "payment_method" => "credit",
            "payment_status" => "card",
            "sub_total" => $totalPrice,
            "discount" => 0,
            "tax_charge" => $totalTax,
            "grand_total" => $grand_total,
            "delivery_date" => $order_date,
        ];
        \DB::beginTransaction();
        $cart = order::create($order);
        $insertedId = $cart->id;
        if($cart){
            foreach ($cartDetails['cart'] as $item) {
                $data = [
                    "order_id" => $insertedId,
                    "product_id" => $item->product_id,
                    "price" => $item->price,
                    "quantity" => $item->quantity,
                    "sub_total" => $item->total_amount,
                ];
                $order_details = order_details::create($data);
            }        
        }
        $delete_cart = \DB::table('tbl_cart')
            ->where('user_id', $user_id)
            ->delete();
        if($delete_cart){
            \DB::commit();
            \Session::flash('success',"Successfully Place Order");
            return redirect(route('website.home'));
        }

    }

    public function my_order(Request $request){
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $user_id = $request->user()->id;
        $cartDetails = ApiHelper::getCartDeatils($request);
        $cart = $cartDetails['cart'];
        $cart_count = $cartDetails['cart_count'];
            $order = Order::where('user_id', $user_id)
                ->with([
                    'order_data' => function ($query) {
                        $query->select('tbl_order_details.id', 'tbl_order_details.product_id', 'tbl_order_details.price', 'tbl_order_details.quantity', 'tbl_order_details.sub_total', 'tbl_order_details.order_id','tbl_product.product_name','tbl_product_images.product_image')
                        ->join('tbl_product', 'tbl_order_details.product_id', '=', 'tbl_product.id')
                        ->join('tbl_product_images', 'tbl_order_details.product_id', '=', 'tbl_product_images.product_id'); 
                    }
                ])
                ->whereHas('order_data', function ($subquery) {
                    $subquery->whereRaw('tbl_order_details.order_id = tbl_order.id');
                })
            ->get();
        return view('website.order.my-order', compact('cart', 'cart_count', 'order'));
    }
    
    public function upcoming_order_details(Request $request,$order_id) {
        if(!auth()->user()){
            return redirect(route('website.login'));
        }
        $cartDetails = ApiHelper::getCartDeatils($request);
        $cart = $cartDetails['cart'];
        $cart_count = $cartDetails['cart_count'];
        $order_details = order_details::where('order_id', $order_id)
            ->selectRaw('tbl_order_details.*,tbl_product_images.product_image,tbl_product.product_name')
            ->join('tbl_product', 'tbl_order_details.product_id', '=', 'tbl_product.id')
            ->join('tbl_product_images', 'tbl_order_details.product_id', '=', 'tbl_product_images.product_id')
            ->get();
        $order = order::where('id', $order_id)
        ->selectRaw('id,sub_total,discount,tax_charge,grand_total,created_at')
        ->get()[0]; 
        return view('website.order.upcoming-order-details', compact('cart', 'cart_count','order_details','order'));
    }

    public function cancel_order(){
        return view('website.order.cancel-order');
    }
    
    public function cancel_order_post(Request $request){
        $this->validate($request,[
            'description' => 'required',
            'image' => 'required'
        ]);
        \Session::flash('success',"Successfully Save Your Request.Our System Contact you Soon");
        return redirect(route('website.home'));
    }
}
