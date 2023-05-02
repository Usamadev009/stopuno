<form action="{{ !empty($deal) ? route('admin.deal.update') : route('admin.deal.save') }}" method="post"
    enctype="multipart/form-data">
    <div class="card-body">
        @csrf
        @if (!empty($deal))
            <input type="hidden" name="id" value="{{ $deal->id }}" />
        @endif
        <div class="row">
            <div class="col-6">
                <div class="form-group" id="deal-name-field">
                    <label for="dealName">Name</label>
                    <input type="text" name="name" class="form-control" id="dealName"
                        placeholder="Enter Deal Name" value="{{ isset($deal->name) ? $deal->name : '' }}"
                        required>
                </div>
            </div>

            <div class="col-6" id="coupon-field">
                <div class="form-group">
                    <label for="coupon">Assign to Coupon</label>
                    <div class="select2-primary">
                        <select class="form-control select2 select2-hidden-accessible search-coupon" name="coupon" data-placeholder="Select Coupon" data-dropdown-css-class="select2-primary" style="width: 100%;" aria-hidden="true" required>
                            <option value="">Please Select</option>
                            @foreach ($coupons as $coupon)
                                <option value="{{ $coupon->id }}" {{(!empty($deal) && $deal->coupon_id == $coupon->id) ? 'selected' : ''}} >{{ $coupon->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6" id="service-field">
                <div class="form-group">
                    <label for="service">Assign to Service</label>
                    <div class="select2-primary">
                        <select class="form-control select2 select2-hidden-accessible search-service" name="service" id="service" data-placeholder="Select service" data-dropdown-css-class="select2-primary" style="width: 100%;" aria-hidden="true">
                            <option value="">Please Select</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" {{(!empty($deal) && $deal->service_id == $service->id) ? 'selected' : ''}}>{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="btn btn-default btn-file">
                        <i class="fas fa-image"></i> <span class="h5">Image</span>
                        <input type="file" name="deal_image" id="upload-image" accept="image/*">
                    </div>
                    <p class="help-block">Max. 5MB</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group clearfix">
                    <div class="icheck-primary d-inline mr-5">
                        <input type="checkbox" id="deal-availability" name="all" value="1" {{(!empty($deal) && $deal->all != 0) ? '' : 'checked'}}>
                        <label for="deal-availability">Available For All</label>
                    </div>
                </div>
            </div>
            <div class="col-6 {{!empty($branches) ? '' : 'd-none'}}" id="branch-field">
                <div class="form-group">
                    <label for="branch">Assign to Branch(es)</label>
                    <div class="select2-primary">
                        <select class="form-control select2 select2-hidden-accessible search-branch" id="branch" name="branch[]" multiple data-placeholder="Select Branch" data-dropdown-css-class="select2-primary" style="width: 100%;" aria-hidden="true">
                            <option value="">Please Select</option>
                            @if(!empty($branches))
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" selected>{{ $branch->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 {{ !empty($deal->image) ? '' : 'd-none' }}" id="image-display">
                @if (!empty($deal->image))
                    <img class="img-fluid" src="{{ asset($deal->image) }}" alt="img" style="max-height:200px; max-width=" 100px">
                @endif
            </div>
        </div>
    </div>

    <!-- /.card-body -->
    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                
                <input type="submit" value="Save" class="btn btn-primary float-right">
            </div>
        </div>
    </div>

</form>

@once
    @push('custom_scripts')
        <script>
            $(document).ready(function() {
                $('.select2').select2()

                // $(".search-service").on('change', function(){
                //     if($(this).val() != ""){
                //         $("#branch-field").removeClass('d-none');
                //     }else{
                //         $("#branch-field").addClass('d-none');
                //     }
                // });
                
                $("#deal-availability").on('click', function(){
                    if($(this).is(":checked")){
                        $("#branch-field").addClass('d-none');
                    }else{
                        $("#branch-field").removeClass('d-none');
                    }
                });

                $('.search-branch').select2();
                $('.search-branch').select2({
                    ajax: {
                        url: "{{ route('helper.branch') }}",
                        dataType: "json",
                        data: function(params) {
                            return {
                                search: params.term, // search term
                                service_id: $("#service option:selected").val()
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.result,
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
@endonce
