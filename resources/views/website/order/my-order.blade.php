{{-- @php
    echo "<pre>";
    print_r($order);
    die;
@endphp --}}
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
                    <h1>My Order</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                    <li class="breadcrumb-item active">My Order</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
    <div class="myorderpage section pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="tab-style3 my-order-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="Current-tab" data-toggle="tab" href="#Current" role="tab" aria-controls="Current" aria-selected="true">Current</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Delivered-tab" data-toggle="tab" href="#Delivered" role="tab" aria-controls="Delivered" aria-selected="false">Delivered</a>
                        </li>
                        
                    </ul>
                    <div class="tab-content shop_info_tab">
                        <div class="tab-pane fade active show" id="Current" role="tabpanel" aria-labelledby="Current-tab">
                            <div class="row">
                                @foreach ($order as $key=>$value)
                                @php
                                    $count = count($value->order_data);
                                    // echo "<pre>";
                                    // print_r($value->order_data[0]->prosuct_name);  
                                @endphp
                                <div class="col-md-6">
                                    <div class="my-order-box box-shadow">
                                        <a href="{{route('website.upcoming-order-details', ['order_id' => $value->id])}}">
                                        <div class="order-header">
                                            <label class="text-primary float-right">On The Way</label>
                                            <h5>Order Id : {{$value->id}}</h5>
                                            <span>{{$value->created_at->format('d M, Y • g:i a')}} </span>
                                            {{-- <span>25 Dec, 2020  • 3:00 pm </span> --}}
                                        </div>
                                        <div class="order-body">
                                            <div class="order-img">
                                                <img src="{{ asset('wafrah_assets/images/'.$value->order_data[0]->product_image)}}">
                                            </div>
                                            <div class="order-detail">
                                                <span>+ {{$count}} More</span>
                                                <h6>Ordered Items </h6>
                                                <label>{{$value->order_data[0]->product_name}}</label>
                                            </div>
                                        </div>
                                        <div class="order-footer">
                                            <span>Paid by</span>
                                            <div class="paid-detail">
                                                <label><img src="{{ asset('wafrah_assets/images/mastercard.svg')}}"> •••• •••• 1234</label>
                                                <p>OMR {{$value->grand_total}}</p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Delivered" role="tabpanel" aria-labelledby="Delivered-tab">
                           <div class="row">
                              @foreach ($order as $key=>$value)
                                @php
                                    $count = count($value->order_data);
                                    // echo "<pre>";
                                    // print_r($value->order_data[0]->prosuct_name);  
                                @endphp
                                <div class="col-md-6">
                                    <div class="my-order-box box-shadow">
                                        <a href="{{route('website.upcoming-order-details', ['order_id' => $value->id])}}">
                                        <div class="order-header">
                                            <label class="text-primary float-right">On The Way</label>
                                            <h5>Order Id : {{$value->id}}</h5>
                                            <span>{{$value->created_at->format('d M, Y • g:i a')}} </span>
                                            {{-- <span>25 Dec, 2020  • 3:00 pm </span> --}}
                                        </div>
                                        <div class="order-body">
                                            <div class="order-img">
                                                <img src="{{ asset('wafrah_assets/images/'.$value->order_data[0]->product_image)}}">
                                            </div>
                                            <div class="order-detail">
                                                <span>+ {{$count}} More</span>
                                                <h6>Ordered Items </h6>
                                                <label>{{$value->order_data[0]->product_name}}</label>
                                            </div>
                                        </div>
                                        <div class="order-footer">
                                            <span>Paid by</span>
                                            <div class="paid-detail">
                                                <label><img src="{{ asset('wafrah_assets/images/mastercard.svg')}}"> •••• •••• 1234</label>
                                                <p>OMR {{$value->grand_total}}</p>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    








@include('website.inc.footer');
@include('website.inc.script');

</body>

</html>