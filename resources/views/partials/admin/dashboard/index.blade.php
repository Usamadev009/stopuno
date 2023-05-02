<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$platformCount}}</h3>

            <p>Total Active Platforms</p>
          </div>
          <div class="icon">
            <i class="fas fa-chart-pie"></i>
          </div>
          <a href="{{ route('admin.services') }}" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{$categoryCount}}</h3>

            <p>Total Active Categories</p>
          </div>
          <div class="icon">
            <i class="fas fa-layer-group"></i>
          </div>
          <a href="{{ route('admin.category') }}" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$sellerServiceCount}}</h3>

            <p>Total Active Sellers</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-tie"></i>
          </div>
          <a href="{{ route('admin.seller-service') }}" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>{{$sellerServiceCount}}</h3>

            <p>Total Active Deals</p>
          </div>
          <div class="icon">
            <i class="fas fa-tag"></i>
          </div>
          <a href="{{ route('admin.deal') }}" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-light">
            <div class="inner">
                <h3>{{$userCount}}</h3>

                <p>Total Active Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('admin.user') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$orderCompletedCount}}</h3>

                <p>Total Completed Orders</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="{{ route('admin.user') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$orderPendingCount}}</h3>

                <p>Total Pending Order</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="{{ route('admin.order') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
