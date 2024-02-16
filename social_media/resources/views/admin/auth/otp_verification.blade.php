<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">

		<link rel="shortcut icon" href="assets/images/favicon_1.ico">

		<title>Ubold - Otp Verification</title>

	    @include('admin.includes.style')

	</head>
	<body>
		<div class="account-pages"></div>
		<div class="clearfix"></div>
		<div class="wrapper-page">
			<div class=" card-box">
				<div class="panel-heading">
					<h3 class="text-center"> Verify OTP </h3>
				</div>

				<div class="panel-body">
					<form method="post" action="{{ route('admin.otp_verification_post') }}" role="form" class="text-center">
                        @csrf()
						<input type="hidden" name="email" value="{{ session()->has('user_email') ? session('user_email') : '' }}">
						<div class="alert alert-info alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
								×
							</button>
							Enter your <b>Otp code</b> for further proccess!
						</div>
						<div class="form-group m-b-0">
							<div class="input-group">
								<input type="number" name="otp_code" class="form-control" placeholder="Enter Otp code" >
								<span class="input-group-btn">
									<button type="submit" class="btn btn-pink w-sm waves-effect waves-light">
										Next
									</button> 
								</span>
							</div>
						</div>
						@error('otp_code')
							<span class="error">{{ $message }}</span>
						@enderror

					</form>
				</div>
			</div>
			

		</div>

	    @include('admin.includes.script')

	</body>
</html>