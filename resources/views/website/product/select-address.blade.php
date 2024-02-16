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
                    <h1>Select Address</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                    <li class="breadcrumb-item active">My Addresses</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
    <div class="store-section section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="row">
                    @foreach ($address as $key=>$value)
                        <div class="col-md-6">
                            <div class="address-card box-shadow">
                                <div class="name">
                                    <p class="address-check">
                                        <input type="radio" id="address{{$key+1}}" name="radio-group" checked="">
                                        <label for="address{{$key+1}}"></label>
                                    </p>
                                    <h5>{{$value->company}}</h5>
                                </div>
                                <div class="address-list">
                                    <div class="icon-img">
                                        <img src="{{ asset('wafrah_assets/images/address-location.svg')}}">
                                    </div>
                                    <div class="address-detail">
                                        <p>{{$value->address}}</p>
                                    </div>
                                </div>
                                <div class="address-footer">
                                    <a href="#"><img src="{{ asset('wafrah_assets/images/delete.svg')}}"> Delete</a>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#editAddressModal"><img src="{{ asset('wafrah_assets/images/edit.svg')}}"> Change</a>
                                </div>
                            </div>
                        </div> 
                    @endforeach
                    
                </div>
                <div class="col-lg-12">
                    <div class="add-address mt-2 text-center">
                        <a href="#" data-toggle="modal" data-target="#AddressModal"><img src="{{ asset('wafrah_assets/images/plus.svg')}}"> Add New</a>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="mt-4 text-center">
                        <a href="{{route('website.order_summary')}}" type="submit" class="btn btn-fill-out btn-block" name="login">Continue</a>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    







    @include('website.inc.footer');

    <!-- Address Modal -->
<div class="modal fade" id="AddressModal" tabindex="-1" role="dialog" aria-labelledby="AddressModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="add-address-modal">
                    <div class="bg-white">
                        <div class="map-img">
                            <img src="{{ asset('wafrah_assets/images/map.png')}}" class="img-fluid">
                        </div>
                        <div class="shipping-form pl-0 pr-0 pb-0">
                        <form method="post" class=" row">                            
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="Name">
                            </div>
                            
                            
                            <div class="form-group col-md-12">
                                <select class="form-control">
                                    <option>City</option>
                                    <option>Dubai</option>
                                    <option>Abudhabi</option>                                    
                                </select>
                            </div> 
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="State">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="Area or Street">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="Area or Street">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="postcode" placeholder="Nearby Landmark">
                            </div>                         
                            <div class="form-group col-md-12 mt-2">
                                <a href="#" type="submit" class="btn btn-fill-out btn-block" name="login">Add</a>
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

 <!-- Edit Address Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="AddressModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="add-address-modal">
                    <div class="bg-white">
                        <div class="map-img">
                            <img src="{{ asset('wafrah_assets/images/map.png')}}" class="img-fluid">
                        </div>
                        <div class="shipping-form pl-0 pr-0 pb-0">
                        <form method="post" class=" row">                            
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="Name">
                            </div>
                            
                            
                            <div class="form-group col-md-12">
                                <select class="form-control">
                                    <option>City</option>
                                    <option>Dubai</option>
                                    <option>Abudhabi</option>                                    
                                </select>
                            </div> 
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="State">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="Area or Street">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="Area or Street">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="postcode" placeholder="Nearby Landmark">
                            </div>                         
                            <div class="form-group col-md-12 mt-2">
                                <a href="#" type="submit" class="btn btn-fill-out btn-block" name="login">Add</a>
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