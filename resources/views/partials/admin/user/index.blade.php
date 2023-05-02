<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">Listing</h3>

        <div class="card-tools">
            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button> --}}
            @can('add-user')
                <a href="{{route('admin.user.create')}}" class="float-right">
                    <button type="button" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-plus-square"></i> Add User
                    </button>
                </a>
            @endcan
        </div>
    </div>
    @can('view-user')
        @component('components.admin.user.listing', ['users' => (isset($users) ? $users : '')]) @endcomponent
    @endcan
</div>