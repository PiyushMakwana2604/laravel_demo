<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon_1.ico') }}">

    <title>Ubold - Responsive Admin Dashboard Template</title>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>

</head>

<body>

    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class=" card-box">
            <div class="panel-heading">
                <h3 class="text-center"> Sign Up to <strong class="text-custom">UBold</strong> </h3>
            </div>

            <div class="panel-body">
                <form class="form-horizontal m-t-20" enctype="multipart/form-data" method="post" action="{{route('admin.register.post')}}">
                    @csrf()

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="first_name" value="{{old('first_name')}}" placeholder="First Name">
                            @error('first_name')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="last_name" value="{{old('last_name')}}" placeholder="Last Name">
                            @error('last_name')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="file" name="profile_image" placeholder="Profile Image">
                            @error('profile_image')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" name="email" value="{{old('email')}}" placeholder="Email">
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12" style="display: flex;">
                            <div style="width:25%;margin-right: 1%;">
                                <input class="form-control" type="number" name="country_code" value="{{old('country_code')}}" placeholder="+91" >
                                @error('country_code')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div style="width: -webkit-fill-available">
                                <input class="form-control" type="number" name="phone" value="{{old('phone')}}" placeholder="Phone Number">
                                @error('phone')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" placeholder="Password">
                            @error('password')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
                            @error('password_confirmation')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <select class="form-control" name="gender" aria-label="Default select example">
                                <option disabled selected>Select Gender</option>
                                <option value="male" @if(old('gender') === 'male') selected @endif>Male</option>
                                <option value="female" @if(old('gender') === 'female') selected @endif>Female</option>
                                <option value="other" @if(old('gender') === 'other') selected @endif>Other</option>
                            </select>
                            @error('gender')
                                <span class="error">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light"
                                type="submit">
                                Register
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-center">
                <p>
                    Already have account?<a href="{{ route('admin.login') }}" class="text-primary m-l-5"><b>Sign
                            In</b></a>
                </p>
            </div>
        </div>

    </div>

    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/detect.js') }}"></script>
    <script src="{{ asset('assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>


    <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.app.js') }}"></script>

</body>

</html>
