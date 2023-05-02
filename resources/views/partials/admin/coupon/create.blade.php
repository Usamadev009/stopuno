@push('custom_head')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <!-- bootstrap slider -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap-slider/css/bootstrap-slider.min.css')}}">
@endpush

<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">{{!empty($coupon) ? 'Update' : 'Add'}} Coupon</h3>
    </div>
    @component('components.admin.coupon.coupon_form', ['coupon' => (isset($coupon) ? $coupon : ''), 'coupons' => (isset($coupons) ? $coupons : '')]) @endcomponent
</div>

@push('custom_scripts')
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap slider -->
    <script src="{{asset('plugins/bootstrap-slider/bootstrap-slider.min.js')}}"></script>
@endpush
