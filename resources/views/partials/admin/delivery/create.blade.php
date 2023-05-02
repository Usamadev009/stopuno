@push('custom_head')
    <!-- bootstrap slider -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap-slider/css/bootstrap-slider.min.css')}}">
@endpush

<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">{{!empty($delivery) ? 'Update' : 'Add'}} Delivery</h3>
    </div>
    @component('components.admin.delivery.delivery_form', ['delivery' => (isset($delivery) ? $delivery : ''), 'platforms' => (isset($platforms) ? $platforms : '')]) @endcomponent
</div>

@push('custom_scripts')
    <!-- Bootstrap slider -->
    <script src="{{asset('plugins/bootstrap-slider/bootstrap-slider.min.js')}}"></script>
@endpush
