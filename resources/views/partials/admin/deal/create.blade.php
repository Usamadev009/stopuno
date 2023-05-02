<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">{{!empty($deal) ? 'Update' : 'Add'}} Deal</h3>
    </div>
    @component('components.admin.deal.deal_form', ['deal' => (isset($deal) ? $deal : ''), 'coupons' => (isset($coupons) ? $coupons : ''), 'services' => (isset($services) ? $services : ''), 'branches' => (isset($branches) ? $branches : '')]) @endcomponent
</div>