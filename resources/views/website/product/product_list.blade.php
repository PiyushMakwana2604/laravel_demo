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
    <style>
        /* Custom pagination styles */
        .custom-pagination {
            display: flex;
            list-style: none;
            justify-content: center;
            margin-top: 20px;
        }

        .custom-pagination li {
            margin: 0 5px;
        }

        .custom-pagination a,
        .custom-pagination span {
            padding: 5px 10px;
            border: 1px solid #ccc;
            background-color: #f8f8f8;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
        }

        .custom-pagination .active a {
            background-color: #007bff;
            color: #fff;
            border: 1px solid #007bff;
        }

        .custom-pagination a:hover {
            background-color: #007bff;
            color: #fff;
            border: 1px solid #007bff;
        }
        .category-color {
            color: blue;
        }
    </style>

</head>

<body>
    @include('website.inc.inner-header')

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
            <div class="col-lg-9">
                <div class="row align-items-center mb-4 pb-1">
                    <div class="col-12">
                        <div class="product_header">
                            <div class="product_header_left">
                                
                            </div>
                            <div class="product_header_right">
                                <!-- <div class="products_view">
                                    <a href="javascript:Void(0);" class="shorting_icon grid active"><i class="ti-view-grid"></i></a>
                                    <a href="javascript:Void(0);" class="shorting_icon list"><i class="ti-layout-list-thumb"></i></a>
                                </div> -->
                                <!-- <div class="custom_select">
                                    <select class="form-control form-control-sm first_null not_chosen">
                                        <option value="">Showing</option>
                                        <option value="9">9</option>
                                        <option value="12">12</option>
                                        <option value="18">18</option>
                                    </select>
                                </div> -->
                                <div class="custom_select">
                                    <select class="form-control form-control-sm" id="sorting-dropdown">
                                        <option value="order">Default sorting</option>
                                        <option value="rating-low-to-high">Sort by rating: Low to high</option>
                                        <option value="rating-high-to-low">Sort by rating: High to low</option>
                                        <option value="price-low-to-high">Sort by price: low to high</option>
                                        <option value="price-high-to-low">Sort by price: high to low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row shop_container" id="product_list">
                    @foreach ($product as $key=>$value)
                    <div class="col-md-4 col-6">
                        <div class="product">
                            <div class="product_img">
                                <a href="product-details.php">
                                    <img src="{{ asset('wafrah_assets/images/'.$value->product_image)}}" alt="product_img1">
                                </a>
                                <div class="product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li class="add-to-cart" data-product_id="{{$value->id}}"><a><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                        <li><a href="#"><i class="icon-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title"><a href="{{route('website.product_details', ['product_id' => $value->id])}}">{{$value->product_name}}</a></h6>
                                <div class="product_price">
                                    <span class="price">OMR {{$value->price}}</span>
                                    
                                    <div class="on_sale">
                                        @if($value->discount_value > 0)
                                            <span>{{{$value->discount_value}}}% Off</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width: {{ $value->rating == 5 ? '100%' : ($value->rating / 5 * 100) . '%' }}"></div>
                                    </div>
                                    <span class="rating_num">({{$value->review_count}})</span>
                                </div>
                                <div class="pr_desc">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="pagination mt-3 justify-content-center pagination_style1">
                            {{ $product->links('pagination::simple-bootstrap-4', ['class' => 'custom-pagination']) }}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 order-lg-first  mt-4 pt-2 mt-lg-0 pt-lg-0">
                <div class="sidebar filter-product">
                    <div>
                        <h4 class="widget_title">Filter </h4>
                    </div>
                    <div class="widget">
                        <div class="price_range">
                                 <h5 class="widget_title">Price </h5>
                                 <span id="flt_price">OMR 50 - OMR 300</span>
                                 <input type="hidden" id="price_first">
                                 <input type="hidden" id="price_second">
                             </div>
                        <div class="filter_price">
                             <div id="price_filter" data-min="0" data-max="500" data-min-value="50" data-max-value="300" data-price-sign="OMR" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"></div>
                             
                         </div>
                    </div>
                    <div class="widget">
                        <h5 class="widget_title">Categories</h5>
                        <ul class="widget_categories" id="category-list">
                            <li data-id="0" class="category-color"><a><span class="categories_name">All</span><span class="categories_num">({{$count['total_count']}})</span></a></li>
                            <li data-id="1"><a><span class="categories_name">Mens</span><span class="categories_num">({{$count['mens_count']}})</span></a></li>
                            <li data-id="2"><a><span class="categories_name">Womens</span><span class="categories_num">({{$count['womens_count']}})</span></a></li>
                            <li data-id="3"><a><span class="categories_name">Kids</span><span class="categories_num">({{$count['kids_count']}})</span></a></li>
                        </ul>
                    </div>
                    <div class="widget">
                        <h5 class="widget_title">Store Rating </h5>
                            <div class="range">
                                <input type="range" min="1" max="5" steps="1" value="3" id="ratingSlider">
                            </div>
                            <ul class="range-labels" id="product_rating">
                                <li class="" >Any</li>
                                <li data-rating="3.5">3.5</li>
                                <li class="active selected" data-rating="4.0">4.0</li>
                                <li data-rating="4.5">4.5</li>
                                <li data-rating="5.0">5.0</li>
                            </ul>
                    </div>
                    <div class="mt-5 pt-3">
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" name="checkbox" id="discount" value="">
                            <label class="form-check-label" for="discount"><span>Discount offers</span></label>
                        </div>
                        <div class="mt-3">
                            <a class="btn btn-fill-out btn-sm btn-block" id="apply-button">Apply</a>
                        </div>
                    </div>
                    
                    <!-- <div class="widget">
                        <h5 class="widget_title">Size</h5>
                        <div class="product_size_switch">
                            <span>xs</span>
                            <span>s</span>
                            <span>m</span>
                            <span>l</span>
                            <span>xl</span>
                            <span>2xl</span>
                            <span>3xl</span>
                        </div>
                    </div> -->
                    
                    
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            var priceFirstValue = 50;
            var priceSecondValue = 300;
            var category_id = "0";
            var rating = 4;
            var is_discount = 0;
            var sorting_type = "";
            var is_apply = 0;
            $('#sorting-dropdown').on('change', function () {
                is_apply = 0;
                var selectedOption = $(this).val();
                sorting_type = selectedOption;
                // Send an AJAX request to the server For Product Sorting
                $.ajax({
                    type: 'POST',
                    url: '{{ route('website.product_sorting') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        sorting_type: selectedOption
                    },
                    success: function (response) {
                        var prev_page_url = response.prev_page_url
                        var next_page_url = response.next_page_url
                        var html = "";
                        response.data.forEach(function(value) {
                        var product_id = value.id;
                        var productLink =
                            "{{ route('website.product_details', ['product_id' => ':product_id']) }}";
                        productLink = productLink.replace(':product_id', product_id);
                        html += `<div class="col-md-4 col-6">
                            <div class="product">
                                <div class="product_img">
                                    <a href="product-details.php">
                                        <img src="{{ asset('wafrah_assets/images/${value.product_image}')}}" alt="product_img1">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart" data-product_id="${value.id}"><a><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            
                                            <li><a href="#"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="${productLink}">${value.product_name}</a></h6>
                                    <div class="product_price">
                                        <span class="price">OMR ${value.price}</span>
                                        
                                        <div class="on_sale">
                                            <span>${value.discount_value> 0 ? value.discount_value+'%  Off' : ""}</span>
                                        </div>
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width: ${value.rating == 5 ? '100' : (value.rating / 5 * 98)}% "></div>
                                            
                                        </div>
                                        <span class="rating_num">(${value.review_count})</span>
                                    </div>
                                    <div class="pr_desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                        })
                    $('#product_list').html(html);
                    $(".pagination li:last-child").removeClass('disabled');
                    $(".pagination li:first-child").addClass('disabled');
                    $(".pagination li:first-child ").html("<span class='page-link'>« Previous</span>");
                    $(".pagination li:last-child a.page-link").attr('href', next_page_url);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            
            // Filter Sorting
            $("#category-list li").on("click", function() {
                var id = $(this).data("id");
                $("#category-list li").removeClass("category-color");
                $(this).toggleClass("category-color");
                category_id = id;
            });
            $("#ratingSlider").on("input", function() {
                const ul = $('#product_rating');
                const targetClass = 'active';
                
                const liWithClass = ul.find(`li.${targetClass}`);
                
                if (liWithClass.length > 0) {
                    rating = liWithClass.attr('data-rating');
                }
            });
            var isChecked = false; 
            $("#discount").on("click", function() {
                if (isChecked) {
                    is_discount = 0 ;
                } else {
                    is_discount = 1 ;
                }
                
                isChecked = !isChecked; // Toggle the state
            });
            $("#apply-button").on("click", function(e) {
                is_apply = 1;
                e.preventDefault(); 

                // Get the values of the hidden input fields
                priceFirstValue = $("#price_first").val();
                priceSecondValue = $("#price_second").val();

                if (!priceFirstValue || isNaN(priceFirstValue)) {
                    priceFirstValue = 50; 
                    priceSecondValue = 300; 
                }
                let filter={
                    "priceFirstValue" : priceFirstValue,
                    "priceSecondValue" : priceSecondValue,
                    "category_id" : category_id,
                    "rating" : rating,
                    "is_discount" : is_discount,
                }
                $.ajax({
                    type: 'POST',
                    url: '{{ route('website.product_filter') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        filter: filter
                    },
                    success: function (response) {
                        var html = "";
                        var next_page_url = response.next_page_url; 
                        response.data.forEach(function(value) {
                        var product_id = value.id;
                        var productLink =
                            "{{ route('website.product_details', ['product_id' => ':product_id']) }}";
                        productLink = productLink.replace(':product_id', product_id);
                        html += `<div class="col-md-4 col-6">
                            <div class="product">
                                <div class="product_img">
                                    <a href="product-details.php">
                                        <img src="{{ asset('wafrah_assets/images/${value.product_image}')}}" alt="product_img1">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart" data-product_id="${value.id}"><a><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            
                                            <li><a href="#"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="${productLink}">${value.product_name}</a></h6>
                                    <div class="product_price">
                                        <span class="price">OMR ${value.price}</span>
                                        
                                        <div class="on_sale">
                                            <span>${value.discount_value> 0 ? value.discount_value+'%  Off' : ""}</span>
                                        </div>
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width: ${value.rating == 5 ? '100' : (value.rating / 5 * 98)}% "></div>
                                            
                                        </div>
                                        <span class="rating_num">(${value.review_count})</span>
                                    </div>
                                    <div class="pr_desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        })
                        // console.log(next_page_url);
                    $('#product_list').html(html);
                    $(".pagination li:last-child").removeClass('disabled');
                    $(".pagination li:first-child").addClass('disabled');
                    $(".pagination li:first-child ").html("<span class='page-link'>« Previous</span>");
                    $(".pagination li:last-child a.page-link").attr('href', next_page_url);
                    if(next_page_url == null){
                    $(".pagination li:last-child").addClass('disabled');
                    }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            // Pagination With Ajax
            $(document).on("click", ".pagination a.page-link", function (event) {
                
                event.preventDefault(); // Prevent the default link behavior
                var page = $(this).attr('href').split('page=')[1];
                var data = {
                    _token: '{{ csrf_token() }}',
                    page: page
                };
                var url = '{{ route('website.product_sorting') }}';
                if (is_apply === 1) {
                    url = '{{ route('website.product_filter') }}';
                    var filter={
                        "priceFirstValue" : priceFirstValue,
                        "priceSecondValue" : priceSecondValue,
                        "category_id" : category_id,
                        "rating" : rating,
                        "is_discount" : is_discount,
                    }
                    sorting_type = "";
                } else {
                    var filter = "";
                }
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                        page: page,
                        sorting_type : sorting_type,
                        filter:filter
                    },
                    success: function (response) {
                        var next_page_url = response.next_page_url;
                        var prev_page_url = response.prev_page_url;
                        if (!next_page_url) {
                            $(".pagination li:last-child").addClass('disabled');
                        }else{
                            $(".pagination li:last-child").removeClass('disabled');
                        }
                        $(".pagination li:first-child").removeClass('disabled');
                        if(prev_page_url){
                            $(".pagination li:first-child ").html("<a class='page-link preview_link' href="+prev_page_url+" rel='prev'>« Previous</a>")
                        }else{
                            $(".pagination li:first-child").addClass('disabled');
                            $(".pagination li:first-child ").html("<span class='page-link'>« Previous</span>")
                        }
                        $(".pagination li:last-child a.page-link").attr('href', next_page_url);
                        var html = "";
                        
                        response.data.forEach(function(value) {
                            var product_id = value.id;
                            var productLink =
                                "{{ route('website.product_details', ['product_id' => ':product_id']) }}";
                            productLink = productLink.replace(':product_id', product_id);
                            // var daycareId = value.id;
							// var daycareURL =
							// 	`{{ route('website.product_details', '') }}/${daycareId}`;
                        html += `<div class="col-md-4 col-6">
                            <div class="product">
                                <div class="product_img">
                                    <a href="product-details.php">
                                        <img src="{{ asset('wafrah_assets/images/${value.product_image}')}}" alt="product_img1">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart" data-product_id="${value.id}"><a><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            
                                            <li><a href="#"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="${productLink}">${value.product_name}</a></h6>
                                    <div class="product_price">
                                        <span class="price">OMR ${value.price}</span>
                                        
                                        <div class="on_sale">
                                            <span>${value.discount_value> 0 ? value.discount_value+'%  Off' : ""}</span>
                                        </div>
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width: ${value.rating == 5 ? '100' : (value.rating / 5 * 98)}% "></div>
                                            
                                        </div>
                                        <span class="rating_num">(${value.review_count})</span>
                                    </div>
                                    <div class="pr_desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        })
                    $('#product_list').html(html);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            // Add To Cart Ajax
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
                        if (response) {
                            clickedLink.css('background', 'green'); 
                            setTimeout(function () {
                                clickedLink.css('background', '');
                            }, 1000);
                            var header_cart = `<ul class="cart_list">`;
                            var totalValue = 0;   
                            var totalTax = 0;   
                            response.cart.forEach(function(value) {
                                totalValue += value.quantity * value.price;
                                totalTax += value.charge + value.tax;
                                header_cart += `<li>
                                    <a href="#" class="item_remove"><i class="ion-close"></i></a>
                                    <a href="#"><img src="{{ asset('wafrah_assets/images/${value.product_image}')}}" alt="cart_thumb1">${value.product_name}</a>

                                    <span class="cart_quantity"> ${value.quantity} x <span class="cart_amount"> <span class="price_symbole">OMR</span></span>${value.price}</span>
                                </li>`;
                            });
                            header_cart += `</ul>
                                <div class="cart_footer">

                                    <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">OMR</span></span>${totalValue}</p>

                                    <p class="cart_buttons"><a href="{{route('website.cart')}}" class="btn btn-fill-line rounded-0 view-cart">View Cart</a><a href="#" class="btn btn-fill-out rounded-0 checkout">Checkout</a></p>

                                </div>
                                `;
                                console.log(header_cart);
                            $('#header-cart_details').html(header_cart);
                            $('#header-cart_count').html(response.cart_count);
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

    <script type="text/javascript">
        var sheet = document.createElement('style'),  
        $rangeInput = $('.range input'),
        prefs = ['webkit-slider-runnable-track', 'moz-range-track', 'ms-track'];

        document.body.appendChild(sheet);

        var getTrackStyle = function (el) {  
        var curVal = el.value,
            val = (curVal - 1) * 16.666666667,
            style = '';
        
        // Set active label
        $('.range-labels li').removeClass('active selected');
        
        var curLabel = $('.range-labels').find('li:nth-child(' + curVal + ')');
        
        curLabel.addClass('active selected');
        curLabel.prevAll().addClass('selected');

        return style;
        }

        $rangeInput.on('input', function () {
        sheet.textContent = getTrackStyle(this);
        });

        // Change input value on label click
        $('.range-labels li').on('click', function () {
        var index = $(this).index();
        
        $rangeInput.val(index + 1).trigger('input');
        
        });
    </script>
</body>

</html>