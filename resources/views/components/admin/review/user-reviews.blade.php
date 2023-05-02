<div class="card-body">
    <div class="row">
        <div class="col-12">
            @if(!empty($ratings) && count($ratings) > 0)
                @foreach($ratings as $review)
                <div class="post clearfix">
                    <div class="user-block">
                        @if(!empty($review->user->image))
                            <img class="img-circle img-bordered-sm" src="{{asset($review->user->image)}}" alt="User Image">
                        @else
                            <img class="img-circle img-bordered-sm" src="{{asset('images/user.png')}}" alt="User Image">
                        @endif
                        <span class="username">
                        <a href="#" class="h5">{{$review->user->name}} <span class="text-muted text-sm">Rated({{$review->rating}})</span></a>
                        </span>
                        <span class="description">{{date('dS F, Y', strtotime($review->created_at))}}</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                        {{$review->description}}
                    </p>
                </div>
                @endforeach
            @else
                <p class="text-center font-weight-bold">No record found</p>
            @endif
        </div>
    </div>
</div>