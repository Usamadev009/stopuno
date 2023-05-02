<div class="card-body table-responsive p-0">
    <table class="table table-hover table-bordered table-striped text-nowrap">
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sellerServices as $sellerService)
                <tr>
                    <td width="25%">{{ $sellerService->name }}</td>
                    <td width="25%">
                        @if ($sellerService->status == PENDING)
                            <i class="fas fa-lock text-secondary" title="Pending"></i>
                        @elseif($sellerService->status == ACTIVE)
                            <i class="fas fa-lock-open text-primary" title="Active"></i>
                        @endif
                    </td>
                    <td class="project-actions" width="25%">
                        @can('view-seller_service')
                            <a class="btn btn-info btn-sm"
                                href="{{ route('admin.seller-service.edit', ['id' => $sellerService->id]) }}"
                                title="Edit">
                                <i class="fas fa-eye"></i>
                            </a>
                        @endcan
                        @can('delete-seller_service')
                            <a class="btn btn-danger btn-sm confirmation-modal"
                                data-url="{{ route('admin.seller-service.delete', ['id' => $sellerService->id]) }}"
                                title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sellerServices->links() }}
</div>

@push('custom_modals')
    @component('components.modals.confirmation')
    @endcomponent
@endpush
