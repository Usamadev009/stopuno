@push('custom_head')
    <!-- bootstrap slider -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap-slider/css/bootstrap-slider.min.css')}}">
@endpush

<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">{{!empty($driverPay) ? 'Update' : 'Add'}} Driver Pay</h3>
    </div>
    @component('components.admin.driver-pay.delivery_form', ['delivery' => (isset($driverPay) ? $driverPay : ''), 'services' => (isset($services) ? $services : '')]) @endcomponent
</div>

@push('custom_scripts')
    <!-- Bootstrap slider -->
    <script src="{{asset('plugins/bootstrap-slider/bootstrap-slider.min.js')}}"></script>
@endpush
