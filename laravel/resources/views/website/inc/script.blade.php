<script src="{{ asset('gym_assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('gym_assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('gym_assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{ asset('gym_assets/js/masonry.pkgd.min.js')}}"></script>
<script src="{{ asset('gym_assets/js/jquery.barfiller.js')}}"></script>
<script src="{{ asset('gym_assets/js/jquery.slicknav.js')}}"></script>
<script src="{{ asset('gym_assets/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('gym_assets/js/main.js')}}"></script>

{{-- Delete session flash message data  --}}
<script>
    $(document).ready(function() {
        $('.close-btn').click(function() {
            $(this).closest('.alert').remove();
        });
    });
</script>
