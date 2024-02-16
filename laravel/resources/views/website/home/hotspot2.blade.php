{{-- @php
    echo "<pre>";
    print_r($hotspot->hotspots);
    die;   
@endphp --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Template">
    <meta name="keywords" content="Gym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gym | Hotspot</title>
    @include('website.inc/stylesheet')
    <style>
        .hotspot-section{
            background:black
        }
        .dot {
            width: 15px;
            height: 15px;
            background-color: black;
            border-radius: 50%;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lg-hotspot {
            position: absolute;
            transform: translate(-50%, -50%);
        }

        .hotspot-text {
            position: absolute;
            transform: translate(-50%, -50%);
        }

        .hotspot-tooltip {
            position: absolute;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px;
            border-radius: 5px;
            display: none;
            z-index: 999;
            margin-left: 300%
        }
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
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body>
 
    <!-- Header Section Begin -->
        @include('website.inc/header')
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('gym_assets/img/breadcrumb-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Hotspot</h2>
                        <div class="bt-option">
                            <a href="{{route('website.home-page')}}">Home</a>
                            <span>Hotspot</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    
    <!-- Services Section Begin -->
    <section class="hotspot-section spad">
        <div class="container">
            <form method="post" data-parsley-validate="" enctype="multipart/form-data" id="myForm">
            @csrf   
            <div class="row">
                <!-- Button trigger modal -->
                <button type="button" class="primary-btn btn-normal appoinment-btn" data-toggle="modal" data-target="#exampleModal">
                +Add Image
                </button>
                <button type="button" class="primary-btn btn-normal appoinment-btn ml-4">
                    Show
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="file" id="fileInput" name="hotspot_image" class="form-control" required>
                        <div class="mt-2 hotspot-btn">
                            <div id="imageContainer" style="position: relative;"></div>
                            {{-- <canvas id="imageCanvas" style="width: 100%;display:none;"></canvas> --}}
                        </div>
                    </div>
                    <div>
                        <table class="table table-hover" style="display: none">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Text</th>
                                <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody class="hotspot-listing">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"id="saveButton">Save changes</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </form>
        </div>
        @if (isset($hotspot) && $hotspot->count() > 0)
        <div class="container mt-4">
            <div id="hotspotimage" style="position: relative;">
                <div>
                    <img style="width: 100%;" src="{{ asset('uploads/hotspot_image/'.$hotspot->media)}}">
                    @if ($hotspot->hotspots->count() > 0)
                    @foreach ($hotspot->hotspots as $item)
                    <div style="top: {{$item->y_axis}}%; left: {{$item->x_axis}}%;" class="lg-hotspot lg-hotspot--top-left dot" data-text="{{$item->message}}">
                        <p style="margin:0 0 3px 0;">{{$item->order_id}}</p>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        @endif
    </section>
    <!-- Services Section End -->


    <!-- Footer Section Begin -->
         @include('website.inc/footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('website.inc/script')
    <script>
        $(document).ready(function() {
            var hotspotButtonAdded = false;
            var hotspots = [];
            var i = 1 ;
            // Preview Image
            $("#fileInput").change(function() {
                hotspots = [];
                i = 1 ;
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(".table-hover").css("display", "none");
                        $('.hotspot-listing').html(""); 
                        $("#imageContainer").html(`
                            <div class="lg-hotspot-container">
                                <img id="imagePreview" style="width: 100%;" src="${e.target.result}" />
                            </div>
                        `);
                        if (!hotspotButtonAdded) {
                            $(".hotspot-btn").prepend(`<button type="button" class="btn btn-info addHotspotBtn mb-2">+ Hotspot</button>`);
                            hotspotButtonAdded = true;
                        }
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });

            // Add Hotspot
            $(document).on('click', '.addHotspotBtn', function() {
                $('.addHotspotBtn').removeClass('btn-info').addClass('btn-success');

                $("#imageContainer").on('click', '#imagePreview', function(e) {
                    var image = $('#imagePreview');
                    var imageWidth = image.width();
                    var imageHeight = image.height();

                    var offsetX = e.pageX - image.offset().left; 
                    var offsetY = e.pageY - image.offset().top;

                    var x = (offsetX / imageWidth) * 100; // Percentage relative to image width
                    var y = (offsetY / imageHeight) * 100; // Percentage relative to image height

                    var text = window.prompt("Please Write Something:");
                    var  parts = text.split(' ');
                    var isValid = parts.every(function(part) {
                        return part.length <= 15;
                    });
                    if (text != null && text.trim() != "") {
                        if(isValid){
                            console.log(offsetX,offsetY);
                            // store x and y value in hotspots array
                            hotspots.push({id:i, x: x, y: y, text: text });
                              var html = `
                                <div style="top: ${y}%; left: ${x}%;"
                                    class="lg-hotspot lg-hotspot--top-left dot" id="hotspot_${i}" data-text="${text}">
                                    <p style="margin:0 0 3px 0;">${i}</p>
                                </div>
                            `;
    
                            $('.lg-hotspot-container').append(html);
                            $(".table-hover").css("display", "");
                           
                            var list = `
                            <tr>
                                <th scope="row">${i}</th>
                                <td>${text}</td>
                                <td class="delete-hotspot" data-id="${i}"><span aria-hidden="true">×</span></td>
                            </tr>
                            `;
                            $('.hotspot-listing').append(list); 
                            i++;
                        }else{
                            alert("This message is too long and not use space bettween two word");
                        }
                    }
                });
            });

            // Delete Hotspot
            $(document).on('click', '.delete-hotspot', function() {
                var dataId = $(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this hotspot!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                if (result.isConfirmed) {
                        $(this).closest('tr').remove();
                        $('#hotspot_' + dataId).remove();

                        hotspots = hotspots.filter(function(hotspot) {
                            return hotspot.id !== dataId;
                        });

                        var tbodyElement = $('.hotspot-listing');
                        if (tbodyElement.find('tr').length === 0) {
                            $(".table-hover").css("display", "none");
                            i=1;
                            hotspots = [];
                        }
                    }
                })
            });

            // Hover over hotspot to show text
            $(document).on('mouseenter', '.lg-hotspot', function () {
                var text = $(this).data('text');
                var tooltip = $('<div class="hotspot-tooltip"></div>').text(text);
                $(this).append(tooltip);
                tooltip.fadeIn('fast');
            });

            $(document).on('mouseleave', '.lg-hotspot', function () {
                $('.hotspot-tooltip').remove();
            });

            // save images and hotspots
            // $(document).on('submit', '#myForm', function(e) {
            $('#myForm').submit(function (e) {
                e.preventDefault();

                // Get form data
                var formData = new FormData(this);
                formData.append('hotspots', JSON.stringify(hotspots));
                console.log(formData);
                console.log(hotspots);

                // Perform AJAX request
                $.ajax({
                    url: '{{ route('website.add_hotspot') }}', // Replace with the actual route URL
                    type: 'POST',
                    data:formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                       if(response == "1"){
                        window.location.reload();
                       }
                    // console.log(response);    
                    },
                    error: function (xhr, status, error) {
                        // Handle the error response
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            var hotspotButtonAdded = false;
            var hotspots = [];
            // Preview Image
            $("#fileInput").change(function() {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imageCanvas = $('#imageCanvas')[0];
                        var ctx = imageCanvas.getContext("2d");

                        var img = new Image();
                        img.src = e.target.result;

                        img.onload = function() {
                            // Set the canvas size to match the selected image
                            imageCanvas.width = img.width;
                            imageCanvas.height = img.height;

                            // Draw the selected image on the canvas
                            ctx.drawImage(img, 0, 0, img.width, img.height);
                        };
                    };
                    $("#imageCanvas").css("display", "");
                    if (!hotspotButtonAdded) {
                        $(".hotspot-btn").prepend(`<button type="button" class="btn btn-info addHotspotBtn mb-2">+ Hotspot</button>`);
                        hotspotButtonAdded = true; 
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            // Add Hotspot
            $(document).on('click', '.addHotspotBtn', function() {
                $('.addHotspotBtn').removeClass('btn-info').addClass('btn-success');
                $("#imageCanvas").on('click', function(e) {
                    var canvasWidth = $(this).width();
                    var canvasHeight = $(this).height();

                    // Get the original dimensions of the canvas
                    var originalWidth = $(this).attr("width");
                    var originalHeight = $(this).attr("height");

                    // Calculate the scaling factors
                    var scaleX = canvasWidth / originalWidth;
                    var scaleY = canvasHeight / originalHeight;

                    // Calculate the coordinates on the original canvas
                    var originalX = e.pageX - $(this).offset().left;
                    var originalY = e.pageY - $(this).offset().top;

                    // Calculate the scaled coordinates
                    var x = originalX / scaleX;
                    var y = originalY / scaleY;
                    var text = window.prompt("Please Write Something:");
                    if(text != null && text.trim() != ""){
                        console.log(text);
                        // store x and y value in hotspots array
                        hotspots.push({ x: x, y: y, text: text });
                        var html = `
                        <div style="top: 20%; left: 19.9%;" class="lg-hotspot lg-hotspot--top-left">
                            <div class="lg-hotspot__button"></div>
                            <div class="lg-hotspot__label">
                                <h4>This is the title</h4>
                                <p>${text}</p>
                            </div>
                        </div>
                        `;
                        // Draw a circle on the canvas
                        var ctx = this.getContext("2d");
                        ctx.beginPath();
                        ctx.arc(x, y, 50, 0, 2 * Math.PI);
                        ctx.fillStyle = "black";
                        ctx.fill();
                        ctx.closePath();
                        console.log(html);
                        $('body').append(html);
                        // Display the text below the circle
                        // ctx.font = "150px Arial";
                        // ctx.fillStyle = "black";
                        // ctx.textAlign = "center";
                        // ctx.fillText(text, x, y + canvasHeight * 0.2);
                    }
                });
            });

            // save images and hotspots
            $('#saveButton').on('click', function() {
                console.log(hotspots);
            });
        });
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
