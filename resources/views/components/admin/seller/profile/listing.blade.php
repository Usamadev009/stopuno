<table class="table table-hover table-bordered table-striped text-nowrap">
    <thead>
        <tr>
            <th>Phone</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sellers as $seller)
            <tr>
                <td width="40%">{{ $seller->phone }}</td>
                <td width="30%">{{ $seller->email }}</td>
                <td width="30%">
                    @if ($seller->status == ACTIVE)
                        <i class="fas fa-lock-open text-primary" title="Active"></i>
                    @else
                        {{-- ($seller->status == PENDING) --}}
                        <i class="fas fa-lock text-secondary" title="Pending"></i>
                    @endif
                </td>
                <td class="project-actions" width="30%">
                    <a class="btn btn-info btn-sm confirmation-modal"
                        data-url="{{ route('admin.seller.status', ['id' => $seller->id, 'status' => ACTIVE]) }}">
                        <i class="fas fa-lock-open">
                        </i>
                        Active
                    </a>
                    <a class="btn btn-danger btn-sm confirmation-modal"
                        data-url="{{ route('admin.seller.status', ['id' => $seller->id, 'status' => INACTIVE]) }}">
                        <i class="fas fa-lock">
                        </i>
                        Inactive
                    </a>
                    <a class="btn btn-warning btn-sm confirmation-modal"
                        data-url="{{ route('admin.seller.status', ['id' => $seller->id, 'status' => REJECT]) }}">
                        <i class="fas fa-lock">
                        </i>
                        Reject
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
