<div class="card-body table-responsive p-0">
    <table class="table table-hover table-bordered table-striped text-nowrap">
        <thead>
            <tr>
                <th>Service</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deliveries as $delivery)
                <tr>
                    <td width="40%">{{ $delivery->platform->name }}</td>
                    <td class="project-actions" width="30%">
                        @can('update-delivery')
                            <a class="btn btn-info btn-sm" href="{{ route('admin.delivery.edit', ['id' => $delivery->id]) }}"
                                title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        @endcan
                        @can('delete-delivery')
                            <a class="btn btn-danger btn-sm confirmation-modal"
                                data-url="{{ route('admin.delivery.delete', ['id' => $delivery->id]) }}" title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $deliveries->links() }}
</div>

@push('custom_modals')
    @component('components.modals.confirmation')
    @endcomponent
@endpush
