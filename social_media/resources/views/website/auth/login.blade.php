<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themified.com/friend-finder/index-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Jun 2023 09:38:40 GMT -->

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is social network html5 template available in themeforest......" />
    <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
    <meta name="robots" content="index, follow" />
    <title>Friend Finder | A Complete Social Network Template</title>

    <!-- Stylesheets
    ================================================= -->
    <link rel="stylesheet" href="{{ asset('website_assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('website_assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{ asset('website_assets/css/ionicons.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('website_assets/css/font-awesome.min.css')}}" />

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">

    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('website_assets/images/fav.png')}}" />
    <style>
        input.parsley-success,
        select.parsley-success,
        textarea.parsley-success {
            color: #468847;
            background-color: #DFF0D8;
            border: 1px solid #D6E9C6;
        }

        input.parsley-error,
        select.parsley-error,
        textarea.parsley-error {
            color: #B94A48;
            background-color: #F2DEDE;
            border: 1px solid #EED3D7;
        }

        .parsley-errors-list {
            margin: 2px 0 3px;
            padding: 0;
            list-style-type: none;
            font-size: 0.9em;
            line-height: 0.9em;
            opacity: 0;
            color: #B94A48;

            transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -moz-transition: all .3s ease-in;
            -webkit-transition: all .3s ease-in;
        }

        .parsley-errors-list.filled {
            opacity: 1;
        }
        .error{
            color:red;
        }
    </style>
</head>

<body>

    <!-- Header
    ================================================= -->
    <header id="header-inverse">
        <nav class="navbar navbar-default navbar-fixed-top menu">
            <div class="container">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index-register.html"><img src="{{ asset('website_assets/images/logo.png')}}" alt="logo" /></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right main-menu">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home <span><img src="images/down-arrow.png" alt="" /></span></a>
                            <ul class="dropdown-menu newsfeed-home">
                                <li><a href="index.html">Landing Page 1</a></li>
                                <li><a href="index-register.html">Landing Page 2</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Newsfeed <span><img src="images/down-arrow.png" alt="" /></span></a>
                            <ul class="dropdown-menu newsfeed-home">
                                <li><a href="newsfeed.html">Newsfeed</a></li>
                                <li><a href="newsfeed-people-nearby.html">Poeple Nearly</a></li>
                                <li><a href="newsfeed-friends.html">My friends</a></li>
                                <li><a href="newsfeed-messages.html">Chatroom</a></li>
                                <li><a href="newsfeed-images.html">Images</a></li>
                                <li><a href="newsfeed-videos.html">Videos</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Timeline <span><img src="images/down-arrow.png" alt="" /></span></a>
                            <ul class="dropdown-menu login">
                                <li><a href="timeline.html">Timeline</a></li>
                                <li><a href="timeline-about.html">Timeline About</a></li>
                                <li><a href="timeline-album.html">Timeline Album</a></li>
                                <li><a href="timeline-friends.html">Timeline Friends</a></li>
                                <li><a href="edit-profile-basic.html">Edit: Basic Info</a></li>
                                <li><a href="edit-profile-work-edu.html">Edit: Work</a></li>
                                <li><a href="edit-profile-interests.html">Edit: Interests</a></li>
                                <li><a href="edit-profile-settings.html">Account Settings</a></li>
                                <li><a href="edit-profile-password.html">Change Password</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle pages" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">All Pages <span><img src="images/down-arrow.png" alt="" /></span></a>
                            <ul class="dropdown-menu page-list">
                                <li><a href="index.html">Landing Page 1</a></li>
                                <li><a href="index-register.html">Landing Page 2</a></li>
                                <li><a href="newsfeed.html">Newsfeed</a></li>
                                <li><a href="newsfeed-people-nearby.html">Poeple Nearly</a></li>
                                <li><a href="newsfeed-friends.html">My friends</a></li>
                                <li><a href="newsfeed-messages.html">Chatroom</a></li>
                                <li><a href="newsfeed-images.html">Images</a></li>
                                <li><a href="newsfeed-videos.html">Videos</a></li>
                                <li><a href="timeline.html">Timeline</a></li>
                                <li><a href="timeline-about.html">Timeline About</a></li>
                                <li><a href="timeline-album.html">Timeline Album</a></li>
                                <li><a href="timeline-friends.html">Timeline Friends</a></li>
                                <li><a href="edit-profile-basic.html">Edit Profile</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                                <li><a href="faq.html">FAQ Page</a></li>
                                <li><a href="404.html">404 Not Found</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="contact.html">Contact</a></li>
                    </ul>
                    <form class="navbar-form navbar-right hidden-sm">
                        <div class="form-group">
                            <i class="icon ion-android-search"></i>
                            <input type="text" class="form-control" placeholder="Search friends, photos, videos">
                        </div>
                    </form>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
        </nav>
    </header>
    <!--Header End-->

    <!-- Landing Page Contents
    ================================================= -->
    <div id="lp-register">
        <div class="container wrapper">
            <div class="row">
                <div class="col-sm-5">
                    <div class="intro-texts">
                        <h1 class="text-white">Make Cool Friends !!!</h1>
                        <p>Friend Finder is a social network template that can be used to connect people. The template offers Landing pages, News Feed, Image/Video Feed, Chat Box, Timeline and lot more. <br /> <br />Why are you waiting for? Buy it now.</p>
                        <button class="btn btn-primary">Learn More</button>
                    </div>
                </div>
                <div class="col-sm-6 col-sm-offset-1">
                    <div class="reg-form-container">

                        <!-- Register/Login Tabs-->
                        <div class="reg-options">
                            <ul class="nav nav-tabs">
                                <li><a href="{{route('website.validate')}}">Register</a></li>
                                <li class="active"><a href="website-login">Login</a></li>
                            </ul><!--Tabs End-->
                        </div>

                        <!--Registration Form Contents-->
                        <div class="tab-content">
                            <!--Login-->
                            <div class="tab-pane active" id="login">
                                <h3>Login</h3>
                                <p class="text-muted">Log into your account</p>
                                <!--Login Form-->
                                <form method="post" action="" data-parsley-validate="" name="Login_form" id="Login_form" form-inline="form-inline">
                                    @csrf()
                                    <div class="row">
                                        <div class="form-group col-xs-12">
                                            <label for="my-email" class="sr-only">Email</label>
                                            <input id="my-email" class="form-control input-group-lg" type="text" name="email" title="Enter Email" placeholder="Your Email" value="{{old('email')}}" required/>
                                            @error('email')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-xs-12">
                                            <label for="my-password" class="sr-only">Password</label>
                                            <input id="my-password" class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Password" value="{{old('password')}}" required/>
                                            @error('password')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- <p><a href="#">Forgot Password?</a></p> -->
                                    <p> <a href="" class="text-white-50 ms-1">Forgot password?</a></p>
                                    <button class="btn btn-primary" type="submit">Login Now</button>
                                </form><!--Login Form Ends-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-6">

                    <!--Social Icons-->
                    <ul class="list-inline social-icons">
                        <li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-pinterest"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--preloader-->
    <div id="spinner-wrapper">
        <div class="spinner"></div>
    </div>

    <!-- Scripts
    ================================================= -->
    <script src="{{ asset('website_assets/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('website_assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('website_assets/js/jquery.appear.min.js')}}"></script>
    <script src="{{ asset('website_assets/js/jquery.incremental-counter.js')}}"></script>
    <script src="{{ asset('website_assets/js/script.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

<!-- Mirrored from themified.com/friend-finder/index-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Jun 2023 09:38:41 GMT -->

</html>