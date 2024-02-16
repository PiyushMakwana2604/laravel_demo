@php
    $product = $data['product'];
    $related_products = $data['related_products'];
    // echo "<pre>";
    // print_r($data);
@endphp
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
    <?php
    // include("inc/stylesheet.php");
    $pagename = "";
    ?>

</head>

<body>
    @include('website.inc.stylesheet')
    <!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Product</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                    <li class="breadcrumb-item active">Product</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                <div class="product-image">
                    <div class="product_img_box">
                        <img id="product_img" src='{{ asset('wafrah_assets/images/'.$product->product_image)}}' data-zoom-image="{{ asset('wafrah_assets/images/'.$product->product_image)}}" alt="product_img1" />
                        <a href="#" class="product_img_zoom" title="Zoom">
                            <span class="linearicons-zoom-in"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="pr_detail">
                    <div class="product_description">
                        <h4 class="product_title"><a href="#">{{$product->product_name}}</a></h4>
                        <div class="d-flex justify-content-between">
                        <div class="product_price">
                            <span class="price">OMR {{$product->price}}</span> <small class="text-success">In stock</small>
                            <!-- <del>$55.25</del> -->
                            
                        </div>
                        <div class="on_sale">
                                <span>{{$product->discount_value}}% Off</span>
                            </div>
                        </div>
                        <hr class="mt-1">
                        <div class="d-flex justify-content-between">
                        <div class="pr_switch_wrap">
                            <span class="switch_lable">Size</span><br>
                            <div class="product_size_switch">
                                <span data-size="54">s</span>
                                <span class="active" data-size="56">m</span>
                                <span data-size="58">l</span>
                                <span data-size="60">xl</span>
                                <span  data-size="62">Free Size</span>
                            </div>
                        </div>
                        <div class="rating_wrap">
                                <span class="float-right">Review</span><br>
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width: {{ $product->rating === 5 ? '100%' : ($product->rating / 5 * 100 . '%') }} "></div>
                                    </div>
                                    <span class="rating_num">({{$product->review_count}})</span>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-1">
                        <div class="pr_desc">
                            <p>{{$product->description}}</p>
                        </div>
                        <hr>
                        <div class="store-detail">
                            <h4>Store Details</h4>
                            <div class="store-box">
                                <div class="store-img">
                                    <img src="{{ asset('uploads/store_image/'.$product->store_image)}}">
                                </div>
                                <div class="store-desc">
                                    <h4>{{$product->store_name}}</h4>
                                    <p>{{$product->store_description}}</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <hr>
                    <div id="success-cart">

                    </div>
                    <div class="cart_extra">
                        <div class="cart-product-quantity">
                            <div class="quantity">
                                <input type="button" value="-" class="minus">
                                <input type="text" name="quantity" value="1" title="Qty" class="qty" size="4">
                                <input type="button" value="+" class="plus">
                            </div>
                        </div>
                        <div class="cart_btn">
                            <a style="color: white;" class="btn btn-fill-out btn-addtocart" type="button" id="addToCartButton"><i class="icon-basket-loaded"></i> Add to cart</a>
                            <!-- <a class="add_compare" href="#"><i class="icon-shuffle"></i></a> -->
                            <a class="add_wishlist" href="#"><i class="icon-heart"></i></a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="large_divider clearfix"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-style3">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Additional-info-tab" data-toggle="tab" href="#Additional-info" role="tab" aria-controls="Additional-info" aria-selected="false">Additional info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Reviews (2)</a>
                        </li>
                    </ul>
                    <div class="tab-content shop_info_tab">
                        <div class="tab-pane fade active show" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Vivamus bibendum magna Lorem ipsum dolor sit amet, consectetur adipiscing elit.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                        </div>
                        <div class="tab-pane fade" id="Additional-info" role="tabpanel" aria-labelledby="Additional-info-tab">
                            <table class="table table-bordered">
                                <tbody><tr>
                                    <td>Featured Product</td>
                                    <td>Yes</td>
                                </tr>
                                <tr>
                                    <td>Designer</td>
                                    <td>Jewet</td>
                                </tr>
                                <tr>
                                    <td>Style</td>
                                    <td>Casual, Daily</td>
                                </tr>
                                <tr>
                                    <td>Climate</td>
                                    <td>Summer</td>
                                </tr>
                                <tr>
                                    <td>Material</td>
                                    <td>Silk or Crepe</td>
                                </tr>
                            </tbody></table>
                        </div>
                        <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                            <div class="comments">
                                <h5 class="product_tab_title">2 Review For <span>Blue Dress For Woman</span></h5>
                                <ul class="list_none comment_list mt-4">
                                    <li>
                                        <div class="comment_img">
                                            <img src="{{ asset('wafrah_assets/images/user1.jpg')}}" alt="user1">
                                        </div>
                                        <div class="comment_block">
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:80%"></div>
                                                </div>
                                            </div>
                                            <p class="customer_meta">
                                                <span class="review_author">Alea Brooks</span>
                                                <span class="comment-date">March 5, 2018</span>
                                            </p>
                                            <div class="description">
                                                <p>Lorem Ipsumin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment_img">
                                            <img src="{{ asset('wafrah_assets/images/user2.jpg')}}" alt="user2">
                                        </div>
                                        <div class="comment_block">
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:60%"></div>
                                                </div>
                                            </div>
                                            <p class="customer_meta">
                                                <span class="review_author">Grace Wong</span>
                                                <span class="comment-date">June 17, 2018</span>
                                            </p>
                                            <div class="description">
                                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="review_form field_form">
                                <h5>Add a review</h5>
                                <form class="row mt-3">
                                    <div class="form-group col-12">
                                        <div class="star_rating">
                                            <span data-value="1"><i class="far fa-star"></i></span>
                                            <span data-value="2"><i class="far fa-star"></i></span> 
                                            <span data-value="3"><i class="far fa-star"></i></span>
                                            <span data-value="4"><i class="far fa-star"></i></span>
                                            <span data-value="5"><i class="far fa-star"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <textarea required="required" placeholder="Your review *" class="form-control" name="message" rows="4"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input required="required" placeholder="Enter Name *" class="form-control" name="name" type="text">
                                     </div>
                                    <div class="form-group col-md-6">
                                        <input required="required" placeholder="Enter Email *" class="form-control" name="email" type="email">
                                    </div>
                                   
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Submit Review</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="small_divider"></div>
                <div class="divider"></div>
                <div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="heading_s1">
                    <h3>Releted Products</h3>
                </div>
                <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                    
                @foreach ($related_products as $key=>$value)
                    <div class="item">
                        <div class="product">
                            <div class="product_img">
                                <a href="shop-product-detail.html">
                                    <img src="{{ asset('wafrah_assets/images/'.$value->product_image)}}" alt="product_img1">
                                </a>
                                <div class="product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li class="add-to-cart" data-product_id="{{$value->id}}"><a><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                        
                                        <li><a><i class="icon-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title"><a href="{{route('website.product_details',["product_id" => $value->id])}}">{{$value->product_name}}</a></h6>
                                <div class="product_price">
                                    <span class="price">OMR {{$value->price}}</span>
                                    {{-- <del>OMR55.25</del> --}}
                                    <div class="on_sale">
                                        <span>{{$value->discount_value}}% Off</span>
                                    </div>
                                </div>
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width: {{ $value->rating === 5 ? '100%' : ($value->rating / 5 * 100 . '%') }} "></div>
                                    </div>
                                    <span class="rating_num">({{$value->review_count}})</span>
                                </div>
                                <div class="pr_desc">
                                    <p>{{$value->description}}</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                @endforeach 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->



</div>
<!-- END MAIN CONTENT -->


    @include('website.inc.footer')
    @include('website.inc.script')
    <script>
        $(document).ready(function() {
            $("#addToCartButton").click(function() {
                var productId = {{ $product->id }};
                var selectedSize = $(".product_size_switch span.active").data('size');
                var quantityInput = $(".cart-product-quantity .quantity .qty");
                var quantityValue = quantityInput.val();
                var data = {
                    "product_id" : productId,
                    "selected_size" : selectedSize,
                    "quantity_value" : quantityValue,
                }
                // console.log(data);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('website.add_cart') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        "product_id" : productId,
                        "selected_size" : selectedSize,
                        "quantity_value" : quantityValue
                    },
                    success: function (response) {
                        if (response) {
                            $('#success-cart').html(`<div class="alert alert-success" role="alert">
                                <strong>Success!</strong> Successfully add to Cart
                                <span class="close-btn" style="float: right;cursor: pointer;">&times;</span>
                            </div>`);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
                        console.error(error);
                    }
                });
            });

            $(document).on("click", ".add-to-cart", function () {
                var product_id = $(this).data(product_id);
                product_id = product_id.product_id
                var clickedLink = $(this).find('a'); 
                $.ajax({
                    type: 'POST',
                    url: '{{ route('website.add_cart') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        "product_id" : product_id
                    },
                    success: function (response) {
                        if (response == 1) {
                            clickedLink.css('background', 'green'); 
                            setTimeout(function () {
                                clickedLink.css('background', '');
                            }, 1000);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
                        console.error(error);
                    }
                });
            });


            $(document).on("click", ".close-btn", function (event) {
                $(this).closest('.alert').remove();
            });
        });

    </script>
    
</body>

</html>