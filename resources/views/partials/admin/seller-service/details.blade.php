<div class="card card-outline card-maroon">
<div class="card-header">
    <h3 class="card-title">Business Details</h3>
</div>
@component('components.admin.seller-service.info', ['sellerService' => (isset($sellerService) ? $sellerService : '')]) @endcomponent
</div>
