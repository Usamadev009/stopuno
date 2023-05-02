<div class="card-body table-responsive p-0">
    <table class="table table-hover table-bordered table-striped text-nowrap">
        <thead>
        <tr>
            <th>Title</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td width="50%">{{$role->title}}</td>
                    <td class="project-actions" width="50%">
                        @can('update-role')
                        <a class="btn btn-info btn-sm" href="{{route('admin.role.edit', ['id' => $role->id])}}" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        @endcan
                        @can('delete-role')
                        <a class="btn btn-danger btn-sm confirmation-modal" data-url="{{route('admin.role.delete', ['id' => $role->id])}}" title="Delete">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endcan
                    </td>
                </tr>    
            @endforeach
        </tbody>
    </table>
    {{$roles->links()}}
</div>

@push('custom_modals')
@component('components.modals.confirmation') @endcomponent
@endpush