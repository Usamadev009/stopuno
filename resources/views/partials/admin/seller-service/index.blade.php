@can('view-seller_service')
    <div class="card card-outline card-maroon">
        <div class="card-header">
            <h3 class="card-title">Filter</h3>

            {{-- <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div> --}}
        </div>
        @component('components.filters.seller-service-listing', ['platforms' => $platforms, 'categories' => $categories])
        @endcomponent
    </div>
@endcan

<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">Listing</h3>

        <div class="card-tools">
            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button> --}}
            @can('add-seller_service')
                <a href="{{ route('admin.seller-service.create') }}">
                    <button type="button" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-plus-square"></i> Add Branch
                    </button>
                </a>
            @endcan
        </div>
    </div>
    @can('view-seller_service')
        @component('components.admin.seller-service.listing', ['sellerServices' => isset($sellerServices) ? $sellerServices : ''])
        @endcomponent
    @endcan
</div>
