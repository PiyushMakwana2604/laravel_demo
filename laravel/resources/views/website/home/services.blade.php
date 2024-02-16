<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Template">
    <meta name="keywords" content="Gym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gym | Services</title>
    @include('website.inc/stylesheet')

</head>

<body>
 
    <!-- Header Section Begin -->
        @include('website.inc/header')
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('gym_assets/img/breadcrumb-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Services</h2>
                        <div class="bt-option">
                            <a href="{{route('website.home-page')}}">Home</a>
                            <span>Services</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Services Section Begin -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What we do?</span>
                        <h2>PUSH YOUR LIMITS FORWARD</h2>
                    </div>
                </div>
            </div>
            @php
                $i = 1;
            @endphp
            <div class="row">
                @foreach ($services as  $value)
                @php
                    if($i == 9){
                        $i = 1;
                    }
                @endphp
                @if ($i == 1 || $i == 2 || $i == 5 || $i== 6 )
                  <div class="col-lg-3 o-{{$i}} col-md-6 p-0">
                        <div class="ss-pic">
                            <img src="{{ asset('gym_assets/img/services/'.$value->image)}}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-md-6 p-0">
                        <div class="ss-text">
                            <h4>{{$value->title}}</h4>
                            <p>{{$value->description}}</p>
                            <a href="#">Explore</a>
                        </div>
                    </div>
                    @php
                        $i++;   
                    @endphp
                @else  
                    <div class="col-lg-3 o-{{$i}} col-md-6 p-0">
                        <div class="ss-text">
                            <h4>{{$value->title}}</h4>
                            <p>{{$value->description}}</p>
                            <a href="#">Explore</a>
                        </div>
                    </div>
                    <div class="col-lg-3  col-md-6 p-0">
                        <div class="ss-pic">
                            <img src="{{ asset('gym_assets/img/services/'.$value->image)}}" alt="">
                        </div>
                    </div>
                @php
                    $i++;   
                @endphp
                @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Banner Section Begin -->
    <section class="banner-section set-bg" data-setbg="{{ asset('gym_assets/img/banner-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="bs-text service-banner">
                        <h2>Exercise until the body obeys.</h2>
                        <div class="bt-tips">Where health, beauty and fitness meet.</div>
                        <a href="https://www.youtube.com/watch?v=sCUP0jIZfAw" class="play-btn video-popup mfp-iframe"><i
                                class="fa fa-caret-right"></i></a>
                            {{-- <a href="https://www.youtube.com/watch?v=iraezTzB938" class="play-btn video-popup mfp-iframe" ><i
                            class="fa fa-caret-right"></i></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Pricing Section Begin -->
        @include('website.inc/price')
    <!-- Pricing Section End -->

    <!-- Footer Section Begin -->
         @include('website.inc/footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
         @include('website.inc/script')

</body>

</html>