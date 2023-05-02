<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">Details</h3>
    </div>
    @component('components.admin.order.info', ['order' => (isset($order) ? $order : '')]) @endcomponent
</div>
    