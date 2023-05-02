<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">{{ !empty($subscription) ? 'Update' : 'Add' }} Subscription</h3>
    </div>
    @component('components.admin.subscription.subs_form',
        ['subscription' => isset($subscription) ? $subscription : '', 'platforms' => $platforms])
    @endcomponent
</div>
