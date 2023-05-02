<div class="card-body table-responsive p-0">
    <table class="table table-hover table-bordered table-striped text-nowrap">
        <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Interval</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($subscriptions as $subscription)
                <tr>
                    <td width="30%">{{$subscription->name}}</td>
                    <td width="25%">
                        {{$subscription->price}}
                    </td>
                    <td width="25%">
                        {{config('default-data.interval.'.$subscription->interval)}}
                    </td>
                    <td class="project-actions" width="20%">
                        @can('update-subscription')
                        {{-- <a class="btn btn-info btn-sm" href="{{route('admin.subscription.edit', ['id' => $subscription->id])}}" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a> --}}
                        @endcan
                        @can('delete-subscription')
                        <a class="btn btn-danger btn-sm confirmation-modal" data-url="{{route('admin.subscription.delete', ['id' => $subscription->id])}}" title="Delete">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$subscriptions->links()}}
</div>

@push('custom_modals')
@component('components.modals.confirmation') @endcomponent
@endpush
