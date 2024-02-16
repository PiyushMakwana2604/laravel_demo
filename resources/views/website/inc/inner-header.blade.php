<!-- LOADER -->

<div class="preloader">

    <div class="lds-ellipsis">

        <span></span>

        <span></span>

        <span></span>

    </div>

</div>

<!-- END LOADER -->

<!-- START HEADER -->

<header class="header_wrap fixed-top header_with_topbar">



    <div class="bottom_header dark_skin main_menu_uppercase">

        <div class="container">

            <nav class="navbar navbar-expand-lg"> 

                <a class="navbar-brand" href="index.php">

                    <img class="logo_light" src="{{ asset('wafrah_assets/images/logo.svg')}}" alt="logo" />

                    <img class="logo_dark" src="{{ asset('wafrah_assets/images/logo.svg')}}" alt="logo" />

                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false"> 

                    <span class="ion-android-menu"></span>

                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

                    <ul class="navbar-nav">

                        <li><a class="nav-link nav_item" href="{{route('website.home')}}">Home</a></li>

                        <li><a class="nav-link nav_item" href="{{route('website.about')}}">About</a></li>

                        <li><a class="nav-link nav_item" href="{{route('website.product_list')}}">Shop</a></li>
                        
                        <li><a class="nav-link nav_item" href="{{route('website.logout')}}">Logout</a></li>

                        <li class="dropdown profile-menu">

                            <a data-toggle="dropdown" class="nav-link  dropdown-toggle active" href="#"><img src="{{ asset('wafrah_assets/images/user_img1.jpg')}}"> Julia Robert</a>

                            <div class="dropdown-menu">

                                <ul> 

                                    <li><a class="dropdown-item nav-link nav_item" href="{{route('website.my_order')}}">My Order</a></li>
                                    <li><a class="dropdown-item nav-link nav_item" href="{{route('website.manage_products_seller')}}">Manage Product</a></li>
                                    {{-- <li><a class="dropdown-item nav-link nav_item" href="my-subscription-seller.php">My Subscription</a></li> --}}

                                    <li><a class="dropdown-item nav-link nav_item" href="{{route('website.contact_us')}}">Contact Us</a></li>

                                </ul>

                            </div>   

                        </li>


                    </ul>

                </div>

                <ul class="navbar-nav attr-nav align-items-center">

                    <li><a href="javascript:void(0);" class="nav-link search_trigger"><i class="linearicons-magnifier"></i></a>

                        <div class="search_wrap">

                            <span class="close-search"><i class="ion-ios-close-empty"></i></span>

                            <form>

                                <input type="text" placeholder="Search" class="form-control" id="search_input">

                                <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>

                            </form>

                        </div><div class="search_overlay"></div>

                    </li>
                    @if(isset($cart) && !$cart->isEmpty())
                    
                    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#" data-toggle="dropdown"><i class="linearicons-cart"></i><span class="cart_count" id="header-cart_count">@if(isset($cart_count) && !empty($cart_count)){{$cart_count}}@else 0 @endif</span></a>

                        <div class="cart_box dropdown-menu dropdown-menu-right" id="header-cart_details">

                        @php
                            $totalValue = 0; 
                            $totalTax = 0; 
                        @endphp
                            <ul class="cart_list">
                                @foreach ($cart as $key=>$value)
                                <li>
                                    <a href="#" class="item_remove"><i class="ion-close"></i></a>
                                    <a href="#"><img src="{{ asset('wafrah_assets/images/'.$value->product_image)}}" alt="cart_thumb1">{{$value->product_name}}</a>

                                    <span class="cart_quantity"> {{$value->quantity}} x <span class="cart_amount"> <span class="price_symbole">OMR</span></span>{{$value->price}}</span>
                                </li>
                                @php
                                    $totalValue += $value->quantity * $value->price; 
                                    $totalTax += $value->charge + $value->tax; 
                                @endphp
                                @endforeach
                            </ul>
                            
                            <div class="cart_footer">
                                
                                <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">OMR</span></span>{{$totalValue}}</p>

                                <p class="cart_buttons"><a href="{{route('website.cart')}}" class="btn btn-fill-line rounded-0 view-cart">View Cart</a><a href="{{route('website.select_address')}}" class="btn btn-fill-out rounded-0 checkout">Checkout</a></p>
                                
                            </div>

                        </div>
                        
                    </li>
                    @endif

                </ul>

            </nav>

        </div>

    </div>

</header>

<!-- END HEADER -->