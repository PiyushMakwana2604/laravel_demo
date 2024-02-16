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
    
    @include('website.inc.stylesheet');

</head>

<body class="">
    @include('website.inc.inner-header');

    <div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Cancel Order</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                    <li class="breadcrumb-item active">Cancel Order</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
    <div class="store-section section pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="change-password box-shadow">
                    <div class="password-change-image">
                        <img src="{{ asset('wafrah_assets/images/report.svg')}}">
                        <h4>Before you cancel your order <br>read cancellation policy</h4>
                        
                    </div>
                    <div class="description mb-3">
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. </p>
                    </div>
                    <div class="">
                        <a href="#" type="submit" class="btn btn-fill-out btn-block" data-toggle="modal" data-target="#reportModal">Cancel Order</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
    
    @include('website.inc.footer');

    <!-- Profile Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Report Issue</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="add-address-modal">
                    <div class="bg-white">
                        
                        <div class="shipping-form pl-0 pr-0 pb-0">
                        <form method="post" class=" row" action="{{ route('website.cancel_order.post') }}"> 
                            @csrf()                
                            
                            <div class="form-group col-md-12">
                                <textarea class="form-control" name="description" placeholder="Description"></textarea>
                                @error('description')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group text-center col-md-12">
                                <label class="report-img">
                                    <img src="{{ asset('wafrah_assets/images/gallery.svg')}}"> Add Image
                                    <input type="file" name="image">
                                </label>
                                @error('image')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                                
                            </div>
                            
                            
                                                   
                            <div class="form-group col-md-12 mt-2">
                                <button type="submit" class="btn btn-fill-out btn-block">Report</button>
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

    @include('website.inc.script');

</body>

</html>