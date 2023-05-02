<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{!empty($role) ? 'Update' : 'Add'}} Role</h3>
    </div>
    <div class="card-body">
        @component('components.admin.role.role_permission', ['role' => (isset($role) ? $role : ''), 'permissions' => (isset($permissions) ? $permissions : '')]) @endcomponent
    </div>
</div>