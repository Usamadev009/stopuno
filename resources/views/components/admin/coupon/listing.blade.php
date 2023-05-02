<div class="card-body table-responsive p-0">
    <table class="table table-hover table-bordered table-striped text-nowrap">
        <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($coupons as $coupon)
                <tr>
                    <td width="40%">{{$coupon->name}}</td>
                    <td class="project-actions" width="30%">
                        @can('update-coupon')
                        <a class="btn btn-info btn-sm" href="{{route('admin.coupon.edit', ['id' => $coupon->id])}}" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-secondary btn-sm" href="{{route('admin.coupon.duplicate', ['id' => $coupon->id])}}" title="Duplicate">
                            <i class="fas fa-clone"></i>
                        </a>
                        @endcan
                        @can('delete-coupon')
                        <a class="btn btn-danger btn-sm confirmation-modal" data-url="{{route('admin.coupon.delete', ['id' => $coupon->id])}}" title="Delete">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$coupons->links()}}
</div>

@push('custom_modals')
@component('components.modals.confirmation') @endcomponent
@endpush
