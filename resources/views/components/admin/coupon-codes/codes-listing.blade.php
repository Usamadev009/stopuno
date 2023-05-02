<div class="card-body table-responsive p-0">
    <table class="table table-hover table-bordered table-striped text-nowrap">
        <thead>
        <tr>
            <th>Prefix</th>
            <th>Code</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($codes as $code)
                <tr>
                    <td width="30%">{{!empty($code->coupon_prefix) ? $code->coupon_prefix : '-'}}</td>
                    <td width="40%">{{$code->coupon_code}}</td>
                    <td class="project-actions" width="30%">
                        @can('update-coupon')
                        <a class="btn btn-info btn-sm" href="{{route('admin.coupon.code.edit', ['id' => $code->id])}}" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        @endcan
                        @can('delete-coupon')
                        <a class="btn btn-danger btn-sm confirmation-modal" data-url="{{route('admin.coupon.code.delete', ['id' => $code->id])}}" title="Delete">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$codes->links()}}
</div>

@push('custom_modals')
@component('components.modals.confirmation') @endcomponent
@endpush
