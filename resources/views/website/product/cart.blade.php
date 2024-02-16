<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Page Title -->
    <title>Wafrah</title>

    <!-- Meta Data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">

    @include('website.inc.stylesheet')

</head>

<body class="">
    @include('website.inc.inner-header')

    <div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Cart</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                    <li class="breadcrumb-item active">Cart</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
    <div class="cart section">
    <div class="container">
        <div class="row justify-content-center" id="cart_details">
            <div class="col-12">
                <h5>You have added {{$cart_count}} items</h5>
            </div>
            @php
                $totalValue = 0; 
                $totalTax = 0; 
            @endphp
            @foreach ($cart as $key=>$value)
            @php
                $totalValue += $value->quantity * $value->price; 
                $totalTax += $value->charge + $value->tax; 
            @endphp
            <div class="col-md-6">
                <div class="cart-box box-shadow">
                    <div class="cart-body">
                        <div class="cart-img">
                            <a href="product-details.php"><img src="{{asset('wafrah_assets/images/'.$value->product_image)}}"></a>
                        </div>
                        <div class="cart-detail">
                            <a class="float-right delete_cart" data-cart_id="{{$value->id}}"><img src="{{asset('wafrah_assets/images/delete.svg')}}"></a>
                            <h5>{{$value->product_name}}</h5>
                            <label>OMR {{$value->price}}</label>
                        </div>
                    </div>
                    <div class="cart-footer">
                        <a href="wishlist.php"><i class="fas fa-heart"></i> Move To wishlist</a>
                        <label>OMR {{$value->price*$value->quantity}}</label>
                        <div class="cart-product-quantity">
                            <div class="quantity">
                                {{-- <input type="button" value="-" class="minus"> --}}
                                <input type="number" name="quantity" value="{{$value->quantity}}" title="Qty" class="qty" size="4" data-cart-id="{{$value->id}}" data-price="{{$value->price}}" style="width: 40px">
                                {{-- <input type="button" value="+" class="plus"> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            @endforeach
            <div class="col-12">
                <div class="row justify-content-between">
                    <div class="col-md-4">
                        <div class="coupon-code">
                            <div class="form-group">
                                <input type="text" name="" class="form-control" placeholder="Enter your Coupon Code">
                                <a href="#"><img src="{{asset('wafrah_assets/images/close.svg')}}"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="total-box">
                            <ul>
                                <li><span class="text-success">Sub Total</span> <span class="text-success">OMR {{$totalValue}}</span></li>
                                <li><span>Tax (%)</span> <span>OMR {{$totalTax}}</span></li>
                                <li><span>Delivery Charges</span> <span>FREE</span></li>
                                <hr>
                                <li><span class="total">Total Amount</span> <span class="total">OMR {{$totalValue + $totalTax}}</span></li>
                                <li class="mt-3"><a href="{{route('website.select_address')}}" type="submit" class="btn btn-fill-out btn-block" name="login">Checkout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    @include('website.inc.footer')

    <!-- Address Modal -->
<div class="modal fade" id="AddressModal" tabindex="-1" role="dialog" aria-labelledby="AddressModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="add-address-modal">
                    <div class="bg-white">
                        <div class="map-img">
                            <img src="{{asset('wafrah_assets/images/map.png')}}" class="img-fluid">
                        </div>
                        <div class="shipping-form pl-0 pr-0 pb-0">
                        <form method="post" class=" row">                            
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="Name">
                            </div>
                            
                            
                            <div class="form-group col-md-12">
                                <select class="form-control">
                                    <option>City</option>
                                    <option>Dubai</option>
                                    <option>Abudhabi</option>                                    
                                </select>
                            </div> 
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="State">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="Area or Street">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="Area or Street">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="postcode" placeholder="Nearby Landmark">
                            </div>                         
                            <div class="form-group col-md-12 mt-2">
                                <a href="#" type="submit" class="btn btn-fill-out btn-block" name="login">Add</a>
                            </div>
                        </form>
                        </div>
                        
                    </div>
                </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

    @include('website.inc.script')
    <script>
        $(document).ready(function () {
            var cart_id = "";
            var price = "";
            $(document).on("change", ".qty", function (event) {
                cart_id = $(this).data('cart-id');
                price = $(this).data('price');
                var new_quantity = $(this).val();
                if(new_quantity > 0){
                    updateCartQuantity(cart_id, new_quantity,price);
                }
            });
            $(document).on("click", ".minus", function (event) {
                cart_id = $(this).siblings('.qty').data('cart-id');
                price = $(this).siblings('.qty').data('price');
                var qtyInput = $(this).siblings('.qty'); 
                var new_quantity = parseInt(qtyInput.val());
                updateCartQuantity(cart_id, new_quantity,price);
            });
            $(document).on("click", ".plus", function (event) {
                cart_id = $(this).siblings('.qty').data('cart-id');
                price = $(this).siblings('.qty').data('price');
                var qtyInput = $(this).siblings('.qty'); 
                var new_quantity = parseInt(qtyInput.val());
                updateCartQuantity(cart_id, new_quantity,price);
            });
            function updatecartDetails(response){
                var html = `<div class="col-12">
                    <h5>You have added ${response.cart_count} items</h5>
                </div>`;
                var header_cart = `<ul class="cart_list">`;
                var totalValue = 0;   
                var totalTax = 0;   
                response.cart.forEach(function(value) {
                    totalValue += value.quantity * value.price;
                    totalTax += value.charge + value.tax;
                    html += ` <div class="col-md-6">
                        <div class="cart-box box-shadow">
                            <div class="cart-body">
                                <div class="cart-img">
                                    <a href="product-details.php"><img src="{{asset('wafrah_assets/images/${value.product_image}')}}"></a>
                                </div>
                                <div class="cart-detail">
                                    <a class="float-right delete_cart" data-cart_id="${value.id}"><img src="{{asset('wafrah_assets/images/delete.svg')}}"></a>
                                    <h5>${value.product_name}</h5>
                                    <label>OMR ${value.price}</label>
                                </div>
                            </div>
                            <div class="cart-footer">
                                <a href="wishlist.php"><i class="fas fa-heart"></i> Move To wishlist</a>
                                <label>OMR ${value.price * value.quantity}</label>
                                <div class="cart-product-quantity">
                                    <div class="quantity">
                                        <input type="number" name="quantity" value="${value.quantity}" title="Qty" class="qty" size="4" data-cart-id="${value.id}" data-price="${value.price} " style="width: 40px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> `;
                    header_cart += `<li>
                        <a href="#" class="item_remove"><i class="ion-close"></i></a>
                        <a href="#"><img src="{{ asset('wafrah_assets/images/${value.product_image}')}}" alt="cart_thumb1">${value.product_name}</a>

                        <span class="cart_quantity"> ${value.quantity} x <span class="cart_amount"> <span class="price_symbole">OMR</span></span>${value.price}</span>
                    </li>`;
                });
                html += `<div class="col-12">
                    <div class="row justify-content-between">
                        <div class="col-md-4">
                            <div class="coupon-code">
                                <div class="form-group">
                                    <input type="text" name="" class="form-control" placeholder="Enter your Coupon Code">
                                    <a href="#"><img src="{{asset('wafrah_assets/images/close.svg')}}"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="total-box">
                                <ul>
                                    <li><span class="text-success">Sub Total</span> <span class="text-success">OMR ${totalValue}</span></li>
                                    <li><span>Tax (%)</span> <span>OMR ${totalTax}</span></li>
                                    <li><span>Delivery Charges</span> <span>FREE</span></li>
                                    <hr>
                                    <li><span class="total">Total Amount</span> <span class="total">OMR ${totalValue + totalTax}</span></li>
                                    <li class="mt-3"><a href="{{route('website.select_address')}}" type="submit" class="btn btn-fill-out btn-block" name="login">Checkout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>`;
                header_cart += `</ul>
                <div class="cart_footer">

                    <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">OMR</span></span>${totalValue}</p>

                    <p class="cart_buttons"><a href="{{route('website.cart')}}" class="btn btn-fill-line rounded-0 view-cart">View Cart</a><a href="#" class="btn btn-fill-out rounded-0 checkout">Checkout</a></p>

                </div>
                `;
                $('#cart_details').html(html);
                $('#header-cart_details').html(header_cart);
                $('#header-cart_count').html(response.cart_count);
            }
            function updateCartQuantity(cart_id, new_quantity,price) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('website.update_cart_quantity') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        "cart_id": cart_id,
                        "new_quantity": new_quantity
                    },
                    success: function (response) {
                        if(response){
                            updatecartDetails(response);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
                        console.error(error);
                    }
                });
            }
            $(document).on("click", ".delete_cart", function (event) {
                cart_id = $(this).data('cart_id');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('website.delete_cart') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        "cart_id": cart_id,
                    },
                    success: function (response) {
                        if(response){
                            updatecartDetails(response);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>

</html>