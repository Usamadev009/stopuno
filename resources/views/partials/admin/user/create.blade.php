<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">{{!empty($user) ? 'Update' : 'Add'}} User</h3>
    </div>
    @component('components.admin.user.user_form', ['user' => (isset($user) ? $user : ''), 'roles' => (isset($roles) ? $roles : '')]) @endcomponent
</div>