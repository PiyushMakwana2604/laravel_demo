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

        .lg-image {
            display: block;
            height: 100%;
            width: 100%;
            object-fit: scale-down;
        }

        .lg-hotspot {
            position: absolute;
            margin: 0;
            padding: 0;
            transform: translate(-50%, -50%);
            z-index: 0;
        }

        .lg-hotspot:hover .lg-hotspot__button,
        .lg-hotspot:active .lg-hotspot__button {
            border-color: #ff774c;
        }

        .lg-hotspot--selected {
            z-index: 999;
        }

        .lg-hotspot--selected .lg-hotspot__label {
            opacity: 1;
        }

        .lg-hotspot__button {
            height: 48px;
            width: 48px;
            padding: 0px;
            border-radius: 100%;
            border: 1px solid #ff6000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 999;
            cursor: pointer;
        }

        .lg-hotspot__button:after {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            content: "";
            display: block;
            height: 24px;
            width: 24px;
            border-radius: 100%;
            border: 3px solid white;
            background-color: #ff6000;
            transition: border-color 1s linear;
        }

        .lg-hotspot__label {
            position: absolute;
            padding: 0 0 1.1em 0;
            width: 16em;
            max-width: 50vw;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            font-family: "Open Sans", sans-serif;
            font-size: 14.5px;
            line-height: 1.45em;
            z-index: -1;
            border-radius: 2px;
            user-select: none;
            opacity: 0;
            transition: all 0.1s linear;
        }

        .lg-hotspot__label h4 {
            margin: 0;
            padding: 0.65em 1em;
            background-color: #555;
            font-size: 1.1em;
            font-weight: normal;
            letter-spacing: 0.02em;
            color: white;
            border-radius: 2px 2px 0 0;
        }

        .lg-hotspot__label p {
            margin: 0;
            padding: 1.1em 1em 0 1em;
            color: #333;
        }

        .lg-hotspot--top-left .lg-hotspot__label {
            top: 48px;
            left: 48px;
        }

        .lg-hotspot--top-right .lg-hotspot__label {
            top: 48px;
            right: 48px;
        }

        .lg-hotspot--bottom-right .lg-hotspot__label {
            right: 48px;
            bottom: 48px;
        }

        .lg-hotspot--bottom-left .lg-hotspot__label {
            bottom: 48px;
            left: 48px;
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
                <button type="button" class="primary-btn btn-normal appoinment-btn ml-4 ImageShowHide">
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
                    <img style="width: 100%;" class="HotspotImagesrc" src="{{ asset('uploads/hotspot_image/'.$hotspot->media)}}">
                    @if ($hotspot->hotspots->count() > 0)
                    @foreach ($hotspot->hotspots as $item)
                    <div class="lg-hotspot lg-hotspot--bottom-right" style="top: {{$item->y_axis}}%; left: {{$item->x_axis}}%;" data-text="{{$item->message}}">
                        <div class="lg-hotspot__button"></div>
                        {{-- <div class="lg-hotspot__label">
                            <h4>{{$item->order_id}}</h4>
                            <p>{{$item->message}}</p>
                        </div> --}}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinycolor/1.4.1/tinycolor.min.js"></script>

    <script>
        $(document).ready(function() {
            var hotspotButtonAdded = false;
            var hotspots = [];
            var i = 1 ;
            var imageSrc = $('.HotspotImagesrc').attr('src');
            var srcValue = ""
            if(imageSrc != undefined && imageSrc != null && imageSrc != ""){
                srcValue = true;
                $(".ImageShowHide").text("Hide");
            }else{
                srcValue = false;
                $(".ImageShowHide").remove();
                // $(".ImageShowHide").text("Show");
            }

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

                    // Append the overlay to the image container
                    var image = $('#imagePreview')[0]; // Get the raw DOM element
                    var canvas = document.createElement('canvas');
                    var context = canvas.getContext('2d');

                    // Set canvas size to match the image size
                    canvas.width = image.width;
                    canvas.height = image.height;

                    // Draw the image onto the canvas
                    context.drawImage(image, 0, 0, image.width, image.height);

                    // Get the clicked coordinates relative to the image
                    var coloroffsetX = e.pageX - $(image).offset().left;
                    var coloroffsetY = e.pageY - $(image).offset().top;

                    // Get the color of the clicked pixel
                    var pixel = context.getImageData(coloroffsetX, coloroffsetY, 1, 1).data;
                    var clickedColor  = 'rgba(' + pixel[0] + ',' + pixel[1] + ',' + pixel[2] + ',' + (pixel[3] / 255) + ')';
                    console.log('Clicked color:', clickedColor);

                    // Use TinyColor to manipulate the color
                    var tinyColor = tinycolor(clickedColor);

                    // Get lighter and darker shades
                    var lightColor = tinyColor.lighten(10).toRgbString();
                    var setdarkColor = tinyColor.darken(10).toRgbString();
                    var tinydarkColor = tinycolor(setdarkColor);

                    var darkColor = tinydarkColor.darken(10).toRgbString();

                    // Log the lighter and darker shades
                    console.log('Lighter color:', lightColor);
                    console.log('Darker color:', darkColor);

                    
                    var text = window.prompt("Please Write Something:");
                    if (text != null && text.trim() != "") {
                        var  parts = text.split(' ');
                        var isValid = parts.every(function(part) {
                            return part.length <= 15;
                        });
                        if(isValid){
                            // store x and y value in hotspots array
                            hotspots.push({id:i, x: x, y: y, text: text });
                            var html = `
                              <div class="lg-hotspot lg-hotspot--bottom-right" style="top: ${y}%; left: ${x}%;" id="hotspot_${i}" data-text="${text}">
                                <div class="lg-hotspot__button lg-hotspot_show"></div>
                                </div>
                                `;
                                
                                // <div class="lg-hotspot__label">
                                //     <h4>${i}</h4>
                                //     <p>${text}</p>
                                // </div>
                            $('.lg-hotspot-container').append(html);
                            $('.lg-hotspot_show').off('click').on('click', selectHotspot);

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

            // Image Show Hide
            $(document).on('click','.ImageShowHide',function(){
                // alert("hi");
                if(srcValue){
                    $("#hotspotimage").hide();
                    srcValue = false;
                    $(".ImageShowHide").text("Show");
                }else{
                    $("#hotspotimage").show();
                    srcValue = true;
                    $(".ImageShowHide").text("Hide");
                }
            })
            // Hover over hotspot to show text
            $(document).on('mouseenter', '.lg-hotspot', function () {
                var text = $(this).data('text');
                // alert(text);
                var html = $(`<div class="lg-hotspot__label">
                    <h4>Title</h4>
                    <p>${text}</p>
                </div>`);
                $(this).append(html);
                html.fadeIn('fast');
            });

            $(document).on('mouseleave', '.lg-hotspot', function () {
                $('.lg-hotspot__label').remove();
                $(this).removeClass("lg-hotspot--selected");
            });

            // save images and hotspots
            // $(document).on('submit', '#myForm', function(e) {
            $('#myForm').submit(function (e) {
                e.preventDefault();

                // Get form data
                var formData = new FormData(this);
                formData.append('hotspots', JSON.stringify(hotspots));
                // console.log(formData);
                // console.log(hotspots);

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const selectHotspot = (e) => {
            const clickedHotspot = e.target.parentElement;
            const container = clickedHotspot.parentElement;
            const hotspots = container.querySelectorAll(".lg-hotspot");
            hotspots.forEach(hotspot => {
                if (hotspot === clickedHotspot) {
                    hotspot.classList.toggle("lg-hotspot--selected");
                } else {
                    hotspot.classList.remove("lg-hotspot--selected");
                }
            });
        }

        (() => {
            const buttons = document.querySelectorAll(".lg-hotspot__button");
            buttons.forEach(button => {
                button.addEventListener("click", selectHotspot);
            });
        })();
        (() => {
            const buttons = document.querySelectorAll(".lg-hotspot_show");
            buttons.forEach(button => {
                button.addEventListener("click", selectHotspot);
            });
        })();

    </script>
</body>

</html>
