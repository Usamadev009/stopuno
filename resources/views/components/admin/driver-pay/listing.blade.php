<div class="card-body table-responsive p-0">
    <table class="table table-hover table-bordered table-striped text-nowrap">
        <thead>
        <tr>
            <th>Service</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($driverPays as $driverPay)
                <tr>
                    <td width="40%">{{$driverPay->service->name}}</td>
                    <td class="project-actions" width="30%">
                        @can('update-driver')
                        <a class="btn btn-info btn-sm" href="{{route('admin.driver.edit', ['id' => $driverPay->id])}}" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        @endcan
                        @can('delete-driver')
                        <a class="btn btn-danger btn-sm confirmation-modal" data-url="{{route('admin.driver.delete', ['id' => $driverPay->id])}}" title="Delete">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$driverPays->links()}}
</div>

@push('custom_modals')
@component('components.modals.confirmation') @endcomponent
@endpush
