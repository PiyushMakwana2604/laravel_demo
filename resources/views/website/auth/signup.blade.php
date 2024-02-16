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

<body class="login-signupbg">
    
    <div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
                    <div class="padding_eight_all bg-white">
                        <div class="logo-img">
                            <a href="index.php"><img src="{{ asset('wafrah_assets/images/logo-signup.svg')}}"></a>
                        </div>
                        <div class="heading_s1">
                            <h3>Create Account</h3>
                            <p>Create Account to continue using our web.</p>
                        </div>
                        <form enctype="multipart/form-data" method="post" action="{{route('website.signup.post')}}">
                            @csrf()
                            <div class="form-group">
                                <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" placeholder="First Name">
                                @error('first_name')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" placeholder="Last Name">
                                @error('last_name')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control" name="profile_image">
                                @error('profile_image')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="Your Email">
                                @error('email')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="phone-number">
                                    <select class="form-control" name="country_code">
                                        <option disabled selected>+00</option>
                                        <option value="+91" @if(old('country_code') === '+91') selected @endif>+91</option>
                                        <option value="+24" @if(old('country_code') === '+24') selected @endif>+24</option>
                                        <option value="+93" @if(old('country_code') === '+93') selected @endif>+93</option>
                                    </select>
                                    <input type="number" class="form-control" name="phone" value="{{old('phone')}}" placeholder="Phone Number">
                                </div>
                                @error('country_code')
                                    <span class="error">{{$message}}</span><br>
                                @enderror
                                @error('phone')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" placeholder="Create Password">
                                @error('password')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
                                @error('password_confirmation')
                                    <span class="error">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
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
                            <div class="form-group">
                                <button type="submit" class="btn btn-fill-out btn-block">Next</button>
                            </div>
                        </form>
                        
                        <div class="form-note text-center">Already Have an Account? <a href="login.php">Sign in</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    @include('website.inc.stylesheet')
    
    <?php
    // include("inc/script.php");
    ?>

</body>

</html>