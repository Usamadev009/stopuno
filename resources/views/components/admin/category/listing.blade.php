<div class="card-body table-responsive p-0">
    <table class="table table-hover table-bordered table-striped text-nowrap">
        <thead>
        <tr>
            <th>Name</th>
            {{-- <th>Service</th> --}}
            <th>Parent Category</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($category as $categ)
                <tr>
                    <td width="25%">{{$categ->name}}</td>
                    {{--<td width="25%">
                        @if(isset($categ->platform) && !empty($categ->platform))
                            <span class="badge bg-danger">{{$categ->platform->name}}</span>
                        @else
                            -
                        @endif
                    </td> --}}
                    <td width="25%">
                        @if(isset($categ->parentCategory) && !empty($categ->parentCategory))
                            <span class="badge bg-primary">{{$categ->parentCategory->name}}</span>
                        @else
                            -
                        @endif
                    </td>
                    <td class="project-actions" width="25%">
                        @can('update-category')
                            <a class="btn btn-info btn-sm" href="{{route('admin.category.edit', ['id' => $categ->id])}}" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        @endcan
                        @can('delete-category')
                            <a class="btn btn-danger btn-sm confirmation-modal" data-url="{{route('admin.category.delete', ['id' => $categ->id])}}" title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>
                        @endcan
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
