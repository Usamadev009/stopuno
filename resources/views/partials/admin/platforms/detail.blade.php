<div class="row">
    <div class="col-12">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user shadow-lg">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header text-white" style="background: {{ !empty($platform->color) ? $platform->color : 'black' }} no-repeat center">
                <h5 class="widget-user-username text-right font-weight-bold">
                    <a class="btn btn-info btn-sm" href="{{route('admin.platforms.edit', $platform->id)}}" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a> 
                </h5>
                <h3 class="widget-user-username text-right font-weight-bold">{{$platform->name }}</h3>
                <h5 class="widget-user-desc text-right text-sm">{{ $platform->description }}</h5>
            </div>
            <div class="widget-user-image">
                <img src="{{ !empty($platform->image) ? asset($platform->image) : asset('images/user.png') }}" alt="Logo" class="img-circle" style="width:90px; height:90px">
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-layer-group"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Categories</span>
              <span class="info-box-number">{{$platform->categories->count()}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- small card -->
    </div>
    <div class="col-lg-3 col-6">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-store-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sub Platforms</span>
              <span class="info-box-number">{{$platform->childPlatforms->count()}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- small card -->
    </div>
    <div class="col-lg-3 col-6">
        <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="fas fa-store-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Active Businesses</span>
              <span class="info-box-number">{{$platform->branches()->activeStatus()->count()}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- small card -->
    </div>
    <div class="col-lg-3 col-6">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-store-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Inactive Businesses</span>
              <span class="info-box-number">{{$platform->branches()->customStatus([DELETE, 0])->count()}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- small card -->
    </div>
</div>

@component('partials.admin.platforms.index', ['platforms' => $platform->childPlatforms, 'child' => true]) @endcomponent
@component('partials.admin.category.index', ['category' => $platform->categories]) @endcomponent