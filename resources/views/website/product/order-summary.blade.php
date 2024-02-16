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
    
    @include('website.inc.stylesheet');

</head>

<body class="">
    @include('website.inc.inner-header');

    <div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Order Summary</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                    <li class="breadcrumb-item active">Order Summary</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
    <div class="cart section">
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-7">
                <div class="order-summary box-shadow">
                    <div class="suumary-one">
                        <ul>
                            <li><span>Items</span> <span>{{$cart_count}}</span></li>
                            <li><span>Delivery Date</span> <span>As Soon as Possible</span></li>
                        </ul>
                    </div>
                    <div class="suumary-two">
                        <a href="#" data-toggle="modal" data-target="#editAddressModal" class="float-right"><img src="{{ asset('wafrah_assets/images/edit.svg')}}"></a>
                        <h5>Delivery Address</h5>
                        <div class="summary-address">
                            <h6>Julia Robert</h6>
                            <div class="">
                                <p class="mb-0">Ash Shaikh Abdullah al Anqari, Al Wurud, Riyadh 12254, Saudi Arabia</p>
                                <img src="{{ asset('wafrah_assets/images/address-location.svg')}}">
                            </div> 
                        </div>
                    </div>
                    <div class="summary-order">
                        <h5>Order Info</h5>
                        <div class="row">
                            @php
                                $totalValue = 0; 
                                $totalTax = 0; 
                            @endphp
                            @foreach ($cart as $key=>$value)
                            @php
                                $totalValue += $value->quantity * $value->price; 
                                $totalTax += $value->charge + $value->tax; 
                            @endphp
                                <div class="col-md-12">
                                    <div class="cart-box">
                                        <div class="cart-body">
                                            <div class="cart-img">
                                                <a href="product-details.php"><img src="{{ asset('wafrah_assets/images/'.$value->product_image)}}"></a>
                                            </div>
                                            <div class="cart-detail">
                                                
                                                <h5>{{$value->product_name}}</h5>
                                                <div class="d-flex justify-content-between">
                                                    <span>Qty : {{$value->quantity}}</span>
                                                    <label>OMR {{$value->price}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div> 
                            @endforeach
                        </div>
                    </div>
                    <div class="total-box">
                            <ul>
                                <li><span class="text-success">Sub Total</span> <span class="text-success">OMR {{$totalValue}}</span></li>
                                <li><span class="text-danger">Tax (%)</span> <span class="text-danger">+OMR {{$totalTax}}</span></li>
                                <li><span>Delivery Charges</span> <span>FREE</span></li>
                                <hr>
                                <li><span class="total">Total Amount</span> <span class="total">OMR {{$totalValue + $totalTax}}</span></li>
                                <li class="mt-3"><a href="{{route('website.select_payment')}}" type="submit" class="btn btn-fill-out btn-block" name="login">Checkout</a></li>
                            </ul>
                        </div>
                </div>
            </div>
            
           
        </div>
    </div>
</div>
    
    @include('website.inc.footer');

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
                                <img src="{{ asset('wafrah_assets/images/map.png')}}" class="img-fluid">
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
    @include('website.inc.script');

</body>

</html>