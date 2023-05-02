<div class="card-header">
    <h3 class="card-title font-weight-bold">Items</h3>
</div>
<div class="card-body table-responsive">
    <table class="table table-hover table-bordered table-striped text-nowrap">
        <thead>
        <tr>
            <th>Name</th>
            <th>Menu</th>
            <th>Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td width="25%">{{$item->name}}</td>
                    <td width="25%">{{$item->menu->name}}</td>
                    <td width="15%">{{$item->price}}</td>
                    <td width="15%">
                        @if ($item->status == ACTIVE)
                        <i class="fas fa-lock-open text-primary" title="Active"></i>
                        @else
                        <i class="fas fa-lock text-secondary" title="{{ucfirst(config('default-data.default_status.'.$item->status))}}"></i>
                        @endif
                    </td>
                    <td class="project-actions" width="25%">
                        <a class="btn btn-info btn-sm confirmation-modal"
                            data-url="{{ route('admin.seller-service.item.status.update', ['id' => $item->id, 'status' => ACTIVE]) }}">
                            <i class="fas fa-lock-open"></i>
                            Active
                        </a>
                        <a class="btn btn-danger btn-sm confirmation-modal"
                            data-url="{{ route('admin.seller-service.item.status.update', ['id' => $item->id, 'status' => INACTIVE]) }}">
                            <i class="fas fa-lock"></i>
                            Inactive
                        </a>
                        <a class="btn btn-warning btn-sm confirmation-modal"
                            data-url="{{ route('admin.seller-service.item.status.update', ['id' => $item->id, 'status' => REJECT]) }}">
                            <i class="fas fa-lock"></i>
                            Reject
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {{$category->links()}} --}}
</div>

@push('custom_modals')
@component('components.modals.confirmation') @endcomponent
@endpush
