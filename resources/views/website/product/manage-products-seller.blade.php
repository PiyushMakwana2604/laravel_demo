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
                            <h1>Manage Product</h1>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb justify-content-md-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                            <li class="breadcrumb-item active">Manage Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- END CONTAINER-->
        </div>
        <div class="myorderpage section pt-5 book-request-online">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="tab-style3 my-order-tab">
                            <ul class="nav nav-tabs" id="category-list" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Requests-tab" data-toggle="tab" href="#Requests" role="tab" aria-controls="Requests" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item"  data-category_id="1">
                                    <a class="nav-link" id="Confirmed-tab" data-toggle="tab" href="#Confirmed" role="tab" aria-controls="Confirmed" aria-selected="false">Men</a>
                                </li>
                                <li class="nav-item"  data-category_id="2">
                                    <a class="nav-link" id="In-progress-tab" data-toggle="tab" href="#In-progress" role="tab" aria-controls="In-progress" aria-selected="false">Women</a>
                                </li>
                                <li class="nav-item"  data-category_id="3">
                                    <a class="nav-link" id="Ready-for-pickup-tab" data-toggle="tab" href="#Ready-for-pickup" role="tab" aria-controls="Ready-for-pickup" aria-selected="false">Kids</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab manage-product">
                                <div class="tab-pane fade active show" id="Requests" role="tabpanel" aria-labelledby="Requests-tab">
                                    <div class="row" id="product_list">
                                        @foreach ($data as $key=>$value)
                                        <div class="col-md-3">
                                            <div class="manage-product-seller">
                                                <a>
                                                    <div class="my-order-box box-shadow">                                               
                                                        <img src="{{ asset('wafrah_assets/images/'.$value->product_image)}}">         
                                                    </div>
                                                    <div class="order-title">
                                                        <h5>{{$value->product_name}}</h5>
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

        @include('website.inc.footer')
        @include('website.inc.script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).ready(function () {
            $("#category-list li").on("click", function() {
                var category_id = $(this).data("category_id");
                $.ajax({
                url: '{{route('website.manage_products_post')}}',
                method: "POST",
                data: { 
                    _token: '{{ csrf_token() }}',
                    category_id: category_id 
                },
                success: function (response) {
                 var html = "";
                    response.forEach(function(value) {
                    html += `<div class="col-md-3">
                                <div class="manage-product-seller">
                                    <a>
                                        <div class="my-order-box box-shadow">                                               
                                            <img src="{{ asset('wafrah_assets/images/${value.product_image}')}}">         
                                        </div>
                                        <div class="order-title">
                                            <h5>${value.product_name}</h5>
                                        </div>
                                    </a>
                                </div>
                            </div> `;
                    })
                $('#product_list').html(html);
                },
                error: function (error) {
                    console.error("Error:", error);
                }
            });
            });
        });
        </script>
    </body>
</html>