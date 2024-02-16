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

    <?php
    // include("inc/stylesheet.php");
    $pagename = "";
    ?>
    @include('website.inc.stylesheet')
    <style>
        .error{
            color: red
        }
    </style>
</head>

<body class="login-signupbg">
    
    <div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
                    <div class="padding_eight_all bg-white">
                        <div class="logo-img">
                            <a href="index.php"><img src="{{asset('wafrah_assets/images/logo-signup.svg')}}"></a>
                        </div>
                        <div class="heading_s1">
                            <h3>Sign In</h3>
                            <p>Please login to continue using our web.</p>
                        </div>
                        <form method="post" action="{{ route('website.login.post') }}">
                            @csrf()
                            <div class="form-group">
                                <input type="text"  class="form-control" name="email" value="{{old('email')}}" placeholder="Your Email" required>
                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control"  type="password" name="password" value="{{old('password')}}" placeholder="Password" required>
                                @error('password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class=" form-group text-right">
                                
                                <a href="forgot-password.php" class="">Forgot password?</a>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-fill-out btn-block" type="submit">Sign In</button>
                            </div>
                        </form>
                        <div class="different_login">
                            <span> or</span>
                        </div>
                        <ul class="btn-login list_none text-center">
                            <li><a href="#" class=""><img src="{{asset('wafrah_assets/images/fb.svg')}}"></a></li>
                            <li><a href="#" class=""><img src="{{asset('wafrah_assets/images/google.svg')}}"></a></li>
                        </ul>
                        <div class="form-note text-center">Don't Have an Account? <a href="{{route('website.signup')}}">Create Account</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <?php
    // include("inc/script.php");
    ?>
@include('website.inc.script')
</body>

</html>