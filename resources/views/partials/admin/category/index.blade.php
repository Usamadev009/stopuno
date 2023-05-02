<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">Categories</h3>

        <div class="card-tools">
            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button> --}}
            @can('add-category')
            <a href="{{route('admin.category.create')}}">
                <button type="button" class="btn btn-primary font-weight-bold">
                    <i class="fas fa-plus-square"></i> Add Category
                </button>
            </a>
            @endcan
        </div>
    </div>
    @can('view-category')
        @component('components.admin.category.listing', ['category' => (isset($category) ? $category : '')]) @endcomponent
    @endcan
</div>