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
                    <h1>Payment</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                    <li class="breadcrumb-item active">Payment</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
    <div class="payment-section section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h5>Credit/Debit Cards</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="payment box-shadow">
                            <div class="text-radio">
                              <input id="card1" name="payment-card" type="radio" checked="" class="">
                              <label for="card1">
                                <img src="{{ asset('wafrah_assets/images/mastercard.svg')}}" class="card-image">
                                <img src="{{ asset('wafrah_assets/images/payment-select.svg')}}" class="payment-select">
                                <p>Emma Harris</p>
                                <span>•••• 5678</span>
                              </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment box-shadow">
                            <div class="text-radio">
                              <input id="card2" name="payment-card" type="radio" class="">
                              <label for="card2">
                                <img src="{{ asset('wafrah_assets/images/mastercard1.svg')}}" class="card-image">
                                <img src="{{ asset('wafrah_assets/images/payment-select.svg')}}" class="payment-select">
                                <p>Adam Watkins</p>
                                <span>•••• 5678</span>
                              </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment box-shadow">
                            <div class="text-radio">
                              <input id="card3" name="payment-card" type="radio" class="">
                              <label for="card3">
                                <img src="{{ asset('wafrah_assets/images/visa.svg')}}" class="card-image">
                                <img src="{{ asset('wafrah_assets/images/payment-select.svg')}}" class="payment-select">
                                <p>Anthony Bailey</p>
                                <span>•••• 5678</span>
                              </label>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-12">
                    <div class="add-address mt-2 text-center">
                        <a href="#" data-toggle="modal" data-target="#AddcardModal"><img src="{{ asset('wafrah_assets/images/plus.svg')}}"> Add New</a>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="mt-4 text-center">
                        <a href="{{route('website.add_order')}}" type="submit" class="btn btn-fill-out btn-block" name="login">Pay</a>
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
<div class="modal fade" id="AddcardModal" tabindex="-1" role="dialog" aria-labelledby="AddcardModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Card</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="add-address-modal">
                    <div class="bg-white">
                        
                        <div class="shipping-form pl-0 pr-0 pb-0">
                        <form method="post" class=" row">                            
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="Card Holder Name">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" required="" class="form-control" name="name" placeholder="Card Number">
                            </div>
                            <div class="form-group col-md-9 col-8">
                                <input type="text" id="inputDate" required="" class="form-control" name="name" placeholder="Expiry Date">
                            </div>
                            <div class="form-group col-md-3 col-4">
                                <input type="text" required="" class="form-control" name="name" placeholder="CVV">
                            </div>
                            
                            <div class="form-group col-md-12">
                                <div class="chek-form mb-2">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="savecard" value="">
                                        <label class="form-check-label" for="savecard"><span>Save Card</span></label>
                                    </div>
                                </div>
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

    <script type="text/javascript">
        $(function () {
            $('#inputDate').datepicker({ 
                autoclose: true, 
                todayHighlight: true
            })
        });
    </script>
</body>

</html>