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


</head>

<body class="login-signupbg">
    
    <div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
                    <div class="padding_eight_all bg-white">
                        <div class="logo-img text-center">
                            <a href="index.php"><img src="{{ asset('wafrah_assets/images/otp.svg')}}"></a>
                        </div>
                        <div class="heading_s1 text-center">
                            <h3>Phone Verification</h3>
                            <p>We have sent you an OTP code to +00 123 123 1234</p>
                        </div>
                        <form method="post" class="otp" action="{{ route('website.otp_verification_post') }}">
							@csrf()
						<input type="hidden" name="email" value="{{ session()->has('user_email') ? session('user_email') : '' }}">

                            <label class="text-center d-block">ENTER 4 DIGIT CODE</label>
                            <div class="form-group">
								<input type="number" class="form-control" name="otp1" value="{{ old('otp1') }}" placeholder="" maxlength="1" onkeyup="autoFill(this, 'otp2')">
								<input type="number" class="form-control" name="otp2" value="{{ old('otp2') }}" placeholder="" maxlength="1" onkeyup="autoFill(this, 'otp3')">
								<input type="number" class="form-control" name="otp3" value="{{ old('otp3') }}" placeholder="" maxlength="1" onkeyup="autoFill(this, 'otp4')">
								<input type="number" class="form-control" name="otp4" value="{{ old('otp4') }}" placeholder="" maxlength="1" onkeyup="limitInput(this)">
                            </div>
							@if($errors->has('otp1') || $errors->has('otp2') || $errors->has('otp3') || $errors->has('otp4'))
								<span class="error">Otp Filed was Required And Only 1 number fill in Each and Every box</span>
							@endif
							@error('otp_code')
								<span class="error">{{ $message }}</span>
							@enderror

                            
                            <div class="form-group">
								<button type="submit" class="btn btn-fill-out btn-block" >Verify</button>
                                {{-- <a href="create-profile.php" type="submit" class="btn btn-fill-out btn-block" name="login">Verify</a> --}}
                            </div>
                        </form>
                        <div class="form-note text-center">Didn't receive yet OTP Code? <a href="#">Resend</a></div>
                        
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
	<script>
		function autoFill(currentInput, nextInputName) {
			const currentValue = currentInput.value;
			
			if (currentValue.length === 1) {
				const nextInput = document.querySelector(`input[name="${nextInputName}"]`);
				if (nextInput) {
					nextInput.focus();
				}
			}
			else {
				currentInput.value = currentValue.slice(0, 1); // Truncate input to one character
			}
		}

		function limitInput(input) {
			const inputValue = input.value;
			if (inputValue.length > 1) {
				input.value = inputValue.slice(0, 1); // Truncate input to one character
			}
		}
	</script>
</body>

</html>