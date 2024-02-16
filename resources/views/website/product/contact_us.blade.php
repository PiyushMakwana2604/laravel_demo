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

</head>

<body class="">

    @include('website.inc.inner-header')
    
    <div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Contact Us</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                    <li class="breadcrumb-item active">Contact Us</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
    <div class="store-section section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="change-password box-shadow">
                    <div class="password-change-image mb-3">
                        <img src="{{ asset('wafrah_assets/images/contact.svg')}}">
                        <h4>Get In Touch With Us</h4>
                        <label>Any question? Send us to message and <br>we will get back to you shortly.</label>
                    </div>
                    <div class="text-center mb-3">
                        <a href="#"><img src="{{ asset('wafrah_assets/images/contact-mail.svg')}}"></a>
                        <a href="#"><img src="{{ asset('wafrah_assets/images/contact-call.svg')}}"></a>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success mt-4">
                            <strong>Success!</strong>  {{ session('success') }}
                            <span class="close-btn" style="float: right;cursor: pointer;">&times;</span>
                        </div>
                    @endif
                    @error('error')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <form method="post" action="{{ route('website.contact_us.post') }}">
                        @csrf()
                        <div class="form-group">
                            <input type="text" name="title" placeholder="Title" class="form-control">
                            @error('title')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email" class="form-control">
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Write your message.." rows="4"></textarea>
                            @error('message')
                                    <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-fill-out btn-block">Send</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
    
    @include('website.inc.footer')

    <!-- Profile Modal -->
<div class="modal fade" id="editprofileModal" tabindex="-1" role="dialog" aria-labelledby="editprofileTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="add-address-modal">
                    <div class="bg-white">
                        
                        <div class="shipping-form pl-0 pr-0 pb-0">
                        <form method="post" class=" row"> 
                            <div class="form-group text-center col-md-12">
                                <label class="profile-img">
                                    <img src="{{ asset('wafrah_assets/images/profile-bg.png')}}">
                                    <input type="file" name="">
                                </label>
                                
                            </div>                           
                            <div class="form-group col-md-12">
                                <label>Name</label>
                                <input type="text" required="" class="form-control" name="name" placeholder="Name" value="Julia Robert">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Email</label>
                                <input type="email" required="" class="form-control" name="name" placeholder="Type here..." >
                            </div>
                            <div class="form-group col-md-12">
                                <div class="phone-number">
                                    <select class="form-control">
                                        <option>+00</option>
                                        <option>+91</option>
                                        <option>+124</option>
                                        <option>+0012</option>
                                    </select>
                                    <input type="text" required="" class="form-control" name="phone" placeholder="Phone Number">
                                </div>
                                
                            </div>
                            
                            
                                                   
                            <div class="form-group col-md-12 mt-2">
                                <a href="#" type="submit" class="btn btn-fill-out btn-block" name="login">Save</a>
                            </div>
                        </form>
                        </div>
                        
                    </div>
                </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

    @include('website.inc.script')
    
</body>

</html>