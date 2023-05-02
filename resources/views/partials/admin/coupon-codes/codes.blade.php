<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">Listing</h3>

        <div class="card-tools">
            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button> --}}
            @can('add-coupon')
                <a href="{{ route('admin.coupon.code.create') }}" class="float-right">
                    <button type="button" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-plus-square"></i> Generate Code
                    </button>
                </a>
            @endcan
        </div>
    </div>
    @can('view-coupon')
        @component('components.admin.coupon-codes.codes-listing', ['codes' => isset($codes) ? $codes : ''])
        @endcomponent
    @endcan
</div>
