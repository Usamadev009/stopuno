<div class="card">
    <div class="card-header">
        <h3 class="card-title">Listing</h3>

        <div class="card-tools">
            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button> --}}
            @can('add-role')
                <a href="{{route('admin.role.create')}}">
                    <button type="button" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-plus-square"></i> Add Role
                    </button>
                </a>
            @endcan
        </div>
    </div>
    @can('view-role')
        @component('components.admin.role.listing', ['roles' => (isset($roles) ? $roles : '')]) @endcomponent
    @endcan
</div>