<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Template">
    <meta name="keywords" content="Gym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gym | Gallery</title>
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
                        <h2>Gallery</h2>
                        <div class="bt-option">
                            <a href="{{route('website.home-page')}}">Home</a>
                            <a href="#">Pages</a>
                            <span>Gallery</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Gallery Section Begin -->
    <div class="gallery-section gallery-page">
        <div class="gallery">
            <div class="grid-sizer"></div>
            <div class="gs-item grid-wide set-bg" data-setbg="{{ asset('gym_assets/img/gallery/gallery-1.jpg')}}">
                <a href="{{ asset('gym_assets/img/gallery/gallery-1.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="{{ asset('gym_assets/img/gallery/gallery-2.jpg')}}">
                <a href="{{ asset('gym_assets/img/gallery/gallery-2.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="{{ asset('gym_assets/img/gallery/gallery-3.jpg')}}">
                <a href="{{ asset('gym_assets/img/gallery/gallery-3.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="{{ asset('gym_assets/img/gallery/gallery-4.jpg')}}">
                <a href="{{ asset('gym_assets/img/gallery/gallery-4.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="{{ asset('gym_assets/img/gallery/gallery-5.jpg')}}">
                <a href="{{ asset('gym_assets/img/gallery/gallery-5.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item grid-wide set-bg" data-setbg="{{ asset('gym_assets/img/gallery/gallery-6.jpg')}}">
                <a href="{{ asset('gym_assets/img/gallery/gallery-6.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item grid-wide set-bg" data-setbg="{{ asset('gym_assets/img/gallery/gallery-7.jpg')}}">
                <a href="{{ asset('gym_assets/img/gallery/gallery-7.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="{{ asset('gym_assets/img/gallery/gallery-8.jpg')}}">
                <a href="{{ asset('gym_assets/img/gallery/gallery-8.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="{{ asset('gym_assets/img/gallery/gallery-9.jpg')}}">
                <a href="{{ asset('gym_assets/img/gallery/gallery-9.jpg')}}" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
        </div>
    </div>
    <!-- Gallery Section End -->

    <!-- Footer Section Begin -->
        @include('website.inc/footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('website.inc/script')

</body>

</html>