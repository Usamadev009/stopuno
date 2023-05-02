<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- pace-progress -->
<script src="{{asset('plugins/pace-progress/pace.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/adminlte.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $(".select2").select2();
    });
</script>

{{-- CUSTOM GENERIC JS --}}
<script src="{{asset('js/custom.js')}}"></script>