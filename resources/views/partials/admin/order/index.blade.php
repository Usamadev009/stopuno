<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">Listing</h3>

        <div class="card-tools">
            {{-- @can('add-service')
                <a href="{{route('admin.services.create')}}" class="float-right">
                    <button type="button" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-plus-square"></i> Add Service
                    </button>
                </a>
            @endcan --}}
        </div>
    </div>
    @can('view-order')
        @component('components.admin.order.listing', ['orders' => (isset($orders) ? $orders : '')]) @endcomponent
    @endcan
</div>