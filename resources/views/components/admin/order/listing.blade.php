<div class="card-body table-responsive p-0">
    <table class="table table-hover table-bordered table-striped text-nowrap">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td width="40%">{{$order->user->name}}</td>
                    <td width="40%">{{date("F dS, \a\\t H:i", strtotime($order->created_at))}}</td>
                    <td width="20%">
                        <a class="btn btn-info btn-sm" href="{{route('admin.order.view', ['id' => $order->id])}}" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    {{-- <td class="project-actions" width="30%">
                        @can('update-service')
                        <a class="btn btn-info btn-sm" href="{{route('admin.order.edit', ['id' => $service->id])}}" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        @endcan
                        @can('delete-service')
                        <a class="btn btn-danger btn-sm confirmation-modal" data-url="{{route('admin.order.delete', ['id' => $service->id])}}" title="Delete">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endcan
                    </td> --}}
                </tr>    
            @endforeach
        </tbody>
    </table>
    {{$orders->links()}}
</div>

@push('custom_modals')
@component('components.modals.confirmation') @endcomponent
@endpush