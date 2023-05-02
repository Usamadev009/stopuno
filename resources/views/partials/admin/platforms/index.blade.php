<div class="card card-outline card-maroon">
    <div class="card-header">
        <h3 class="card-title">{{isset($child) ? 'Sub Platforms' : 'Listing'}}</h3>

        <div class="card-tools">
            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button> --}}
            @if(isset($child))
            @can('add-platform')
                <a href="{{route('admin.platforms.create')}}" class="float-right">
                    <button type="button" class="btn btn-primary font-weight-bold">
                        <i class="fas fa-plus-square"></i> Add {{isset($child) ? 'Sub ' : ''}}Platform
                    </button>
                </a>
            @endcan
            @endif
            {{-- <div class="input-group float-right mr-3" style="width: 150px; margin-top:1px">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
            </div> --}}
        </div>
    </div>
    @can('view-platform')
        @component('components.admin.platforms.listing', ['platforms' => (isset($platforms) ? $platforms : '')]) @endcomponent
    @endcan
</div>
