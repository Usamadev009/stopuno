<form action="{{ !empty($sellerService) ? route('admin.seller-service.update') : route('admin.seller-service.save') }}" method="post"
    enctype="multipart/form-data">
    <div class="card-body">
        @csrf
        @if (!empty($sellerService))
            <input type="hidden" name="id" value="{{ $sellerService->id }}" />
        @endif
        <div class="row">
            <div class="col-12">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user shadow-lg">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white"
                        style="background: {{ !empty($sellerService->banner) ? 'url(' . $sellerService->banner . ')' : 'black' }} no-repeat center; height:170px">
                        <h3 class="widget-user-username text-right font-weight-bold">{{ $sellerService->name }}</h3>
                        <h4 class="widget-user-username text-right">{{ $sellerService->platform->name }}</h4>
                        <h5 class="widget-user-desc text-right">{{ $sellerService->description }}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img src="{{ !empty($sellerService->image) ? asset($sellerService->image) : asset('images/user.png') }}"
                            alt="User Avatar" class="img-circle">
                    </div>


                </div>
                <!-- /.widget-user -->
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-star"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Rating</span>
                        <span class="info-box-number">{{ $sellerService->avgRating() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-2">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fas fa-cubes"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Menus</span>
                        <span
                            class="info-box-number">{{ $sellerService->menus()->count() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-2">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Items</span>
                        <span
                            class="info-box-number">{{ $sellerService->items()->count() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-box"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Order Compelted</span>
                        <span
                            class="info-box-number">{{ $sellerService->orders()->where('product_status', 'completed')->count() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-user-clock"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Order Pending</span>
                        <span
                            class="info-box-number">{{ $sellerService->orders()->where('product_status', 'completed')->count() }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group" id="sellerServices-name-field">
                    <label for="sellerServicesName">Name</label>
                    <input type="text" name="name" class="form-control" id="sellerServicesName"
                        placeholder="Enter sellerServices Name" value="{{ isset($sellerService->name) ? $sellerService->name : '' }}"
                        required readonly>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group" id="sellerServices-service-field">
                    <label for="sellerServicesService">Platform</label>
                    <input type="text" name="service" class="form-control" id="sellerServicesService"
                        placeholder="Enter sellerServices Service"
                        value="{{ isset($sellerService->platform) ? $sellerService->platform->name : '' }}" required readonly>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group" id="sellerServices-status-field">
                    <label class="label h2 float-right">
                        @if ($sellerService->status == PENDING)
                            <i class="fas fa-lock text-secondary" title="Pending"></i>
                        @elseif($sellerService->status == ACTIVE)
                            <i class="fas fa-lock-open text-primary" title="Active"></i>
                        @endif
                    </label>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-header">
        <h3 class="card-title font-weight-bold">Questionnaire</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12" id="accordion">
                @if (!empty($sellerService->questionnair))
                    @php $questionnair = json_decode($sellerService->questionnair, true) @endphp
                    @foreach ($questionnair as $q => $qa)
                        <div class="card card-info card-outline">
                            <a class="d-block w-100 collapsed" data-toggle="collapse"
                                href="#collapseQA-{{ $q }}" aria-expanded="false">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        {{ $q + 1 }}. {{ $qa['Q'] }}
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseQA-{{ $q }}" class="collapse" data-parent="#accordion"
                                style="">
                                <div class="card-body">
                                    {{ $qa['A'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-6 {{ !empty($sellerService->image) ? '' : 'd-none' }}" id="image-display">
                @if (!empty($sellerService->image))
                    <img class="img-fluid" src="{{ asset($sellerService->image) }}" alt="img"
                        style="max-height:200px; max-width:100px">
                @endif
            </div>
        </div> --}}
    </div>

    @component('components.admin.seller-service.items', ['items' => $sellerService->items])
    @endcomponent


    <div class="card-header mt-3">
        <h3 class="card-title font-weight-bold">Reviews</h3>
    </div>
    @component('components.admin.review.user-reviews', ['ratings' => $sellerService->ratings])
    @endcomponent
    
    <div class="card-footer">
        <div class="row">
            <div class="col-6">
                <a class="btn btn-success btn-sm confirmation-modal"
                    data-url="{{ route('admin.seller-service.status.update', ['id' => $sellerService->id, 'status' => ACTIVE]) }}"
                    title="Active">
                    <i class="fas fa-lock-open"></i> Active
                </a>
                <a class="btn btn-secondary btn-sm confirmation-modal"
                    data-url="{{ route('admin.seller-service.status.update', ['id' => $sellerService->id, 'status' => INACTIVE]) }}"
                    title="Inactive">
                    <i class="fas fa-lock"></i> Inactive
                </a>
                <a class="btn btn-info btn-sm confirmation-modal"
                    data-url="{{ route('admin.seller-service.status.update', ['id' => $sellerService->id, 'status' => PENDING]) }}"
                    title="Pending">
                    <i class="far fa-clock"></i> Pending
                </a>
            </div>
        </div>
    </div>

</form>

@push('custom_modals')
    @component('components.modals.confirmation')
    @endcomponent
@endpush
