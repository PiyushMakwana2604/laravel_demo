@php
    // dd($data);
@endphp
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Template">
    <meta name="keywords" content="Gym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gym | Class Details</title>
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
                        <h2>Team detail</h2>
                        <div class="bt-option">
                            <a href="{{route('website.home-page')}}">Home</a>
                            <a href="#">Our Team</a>
                            <span>Team Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Breadcrumb Section End -->

    <!-- Class Details Section Begin -->
    <section class="class-details-section spad">
        <div class="container">
            <div class="row">
                <div class="class-details-text">
                    @if (isset($data) && $data)
                        <div class="cd-text">
                            <div class="cd-single-item">
                                <h3>{{$data->type}}</h3>
                                <p>{{$data->description}}</p>
                            </div>
                        </div>
                        <div class="cd-trainer">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="cd-trainer-pic">
                                        <img src="{{ asset('gym_assets/img/team/'.$data->profile_image)}}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cd-trainer-text">
                                        <div class="trainer-title">
                                            <h4>{{$data->name}}</h4>
                                            <span>{{$data->type}}</span>
                                        </div>
                                        <div class="trainer-social">
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                                            <a href="#"><i class="fa fa-instagram"></i></a>
                                            <a href="#"><i class="fa  fa-envelope-o"></i></a>
                                        </div>
                                        <p>{{$data->about}}</p>
                                        <ul class="trainer-info">
                                            <li><span>Age</span>35</li>
                                            <li><span>Weight</span>148lbs</li>
                                            <li><span>Height</span>10' 2``</li>
                                            <li><span>Occupation</span>no-founder</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Class Details Section End -->

    <!-- Footer Section Begin -->
        @include('website.inc/footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
        @include('website.inc/script')

</body>

</html>