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
                    <h1>Order Details</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                    <li class="breadcrumb-item active">Order Details</li>
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
                    <div class="upcoming-order">
                        <label class="text-primary float-right">On The Way</label>
                        <h5>Order Id : {{$order->id}}</h5>
                        <span>{{$order->created_at->format('d M, Y • g:i a')}} </span>
                    </div>
                    <div class="suumary-two">
                        
                        <h5 class="text-blue">Delivery Address</h5>
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
                            @foreach ($order_details as $key=>$value)
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
                                <li><span class="text-success">Sub Total</span> <span class="text-success">OMR {{$order->sub_total}}</span></li>
                                <li><span class="text-danger">Tax (%)</span> <span class="text-danger">+OMR {{$order->tax_charge}}</span></li>
                                <li><span>Delivery Charges</span> <span>FREE</span></li>
                                <hr>
                                <li><span class="total">Total Amount</span> <span class="total">OMR {{$order->grand_total}}</span></li>
                                <li class="mt-3 d-block">
                                    <div class="row order-btn-group">
                                        <div class="col-6">
                                            <a href="{{route('website.cancel_order')}}" type="submit" class="btn btn-fill-line btn-block" name="login">Cancel Order</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" type="submit" class="btn btn-fill-out btn-block" name="login" data-toggle="modal" data-target="#track-modal">Track Order</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                </div>
            </div>
            
           
        </div>
    </div>
</div>
    
    @include('website.inc.footer')

    <!-- Address Modal -->
<div class="modal fade" id="track-modal" tabindex="-1" role="dialog" aria-labelledby="track-modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Track Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="inner-card card-block-sm b-r-4">
                            <div class="row order-tracking-info">
                                <div class="col-12">
                                    <p class="">
                                     Your order status
                                    </p>
                             </div>                               
                         </div>

                         <div class="row order-tracking">
                            
                            <div class="col-lg-1 col-md-2 col-sm-2 col-2 text-center">
                                <span class="tracking-img tracking-green">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                            <div class="col-md-10 col-sm-10 col-10 ">
                                <p class="tracking-info tracking-text-green">
                                    Order Placed
                                    <span> 25 Dec, 2020  • 3:00 pm  </span>
                                </p>
                            </div>
                        </div>
                        <div class="row order-tracking">
                            
                            <div class="col-lg-1 col-md-2 col-sm-2 col-2 text-center">
                                <span class="tracking-img tracking-green">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                            <div class="col-md-10 col-sm-10 col-10">
                                <p class="tracking-info">
                                    Item Picked Up
                                    <span> 26 Dec, 2020  • 3:00 pm  </span>
                                </p>
                            </div>
                        </div>
                        <div class="row order-tracking">
                            
                            <div class="col-lg-1 col-md-2 col-sm-2 col-2 text-center">
                                <span class="tracking-img">
                                    <i class="fa fa-circle"></i>
                                </span>
                            </div>
                            <div class="col-md-10 col-sm-10 col-10">
                                <p class="tracking-info">
                                    On The Way
                                    <!-- <span> We have received your order. </span> -->
                                </p>
                            </div>
                        </div>
                        <div class="row order-tracking">
                            
                            <div class="col-lg-1 col-md-2 col-sm-2 col-2 text-center">
                                <span class="tracking-img tracking-blank">
                                    
                                </span>
                            </div>
                            <div class="col-md-10 col-sm-10 col-10">
                                <p class="tracking-info tracking-disabled">
                                    Delivered
                                </p>
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