<div class="card-body table-responsive p-0">
    <table class="table table-hover table-bordered table-striped text-nowrap">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td width="40%">
                        {{ $user->name }}
                    </td>
                    <td width="40%">{{ $user->email }}</td>
                    <td class="project-actions" width="30%">
                        @can('update-user')
                            <a class="btn btn-info btn-sm" href="{{ route('admin.user.edit', ['id' => $user->id]) }}"
                                title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        @endcan
                        @can('delete-user')
                            <a class="btn btn-danger btn-sm confirmation-modal"
                                data-url="{{ route('admin.user.delete', ['id' => $user->id]) }}" title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>

@push('custom_modals')
    @component('components.modals.confirmation')
    @endcomponent
@endpush
