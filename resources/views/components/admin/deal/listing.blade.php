<div class="card-body table-responsive p-0">
    <table class="table table-hover table-bordered table-striped text-nowrap">
        <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($deals as $deal)
                <tr>
                    <td width="40%">{{$deal->name}}</td>
                    <td class="project-actions" width="30%">
                        @can('update-deal')
                        <a class="btn btn-info btn-sm" href="{{route('admin.deal.create', ['id' => $deal->id])}}" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        @endcan
                        @can('delete-deal')
                        <a class="btn btn-danger btn-sm confirmation-modal" data-url="{{route('admin.deal.delete', ['id' => $deal->id])}}" title="Delete">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$deals->links()}}
</div>

@push('custom_modals')
@component('components.modals.confirmation') @endcomponent
@endpush
