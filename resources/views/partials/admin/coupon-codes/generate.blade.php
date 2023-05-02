<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">Generate Coupon</h3>
    </div>
    @component('components.admin.coupon-codes.generate_form', ['coupons' => (isset($coupons) ? $coupons : ''), 'users' => (isset($users) ? $users : ''), 'branches' => (isset($branches) ? $branches : ''), 'code' => (isset($code) ? $code : ''), 'couponCode' => (isset($couponCode) ? $couponCode : '')]) @endcomponent
</div>

