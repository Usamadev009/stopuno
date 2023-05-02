<div class="card-body table-responsive p-0">
    <table class="table table-hover table-bordered table-striped text-nowrap">
        <thead>
            <tr>
                <th>Name</th>
                <th>Parent Platform</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($platforms as $platform)
                <tr>
                    <td width="40%">{{ $platform->name }}</td>
                    <td width="30%">
                        @if (isset($platform->parentPlatform) && !empty($platform->parentPlatform))
                            <span class="badge bg-danger">{{ $platform->parentPlatform->name }}</span>
                        @else
                            -
                        @endif
                    </td>
                    <td class="project-actions" width="30%">
                        @can('update-platform')
                            <a class="btn btn-info btn-sm" href="{{ route('admin.platforms.view', ['id' => $platform->id]) }}"
                                title="Edit">
                                <i class="fas fa-eye"></i>
                            </a>
                        @endcan
                        @can('delete-platform')
                            <a class="btn btn-danger btn-sm confirmation-modal"
                                data-url="{{ route('admin.platforms.delete', ['id' => $platform->id]) }}" title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($platforms instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $platforms->links() }}
    @endif
</div>

{{-- @push('custom_modals')
@component('components.modals.confirmation') @endcomponent
@endpush --}}
