@push('custom_head')
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
@endpush

<form action="{{ !empty($coupon) ? route('admin.coupon.update') : route('admin.coupon.save') }}" method="post"
    enctype="multipart/form-data">
    <div class="card-body">
        @csrf
        @if (!empty($coupon))
            <input type="hidden" name="id" value="{{ $coupon->id }}" />
        @endif
        <div class="row">
            <div class="col-6">
                <div class="form-group" id="coupon-name-field">
                    <label for="couponName">Name</label>
                    <input type="text" name="name" class="form-control" id="couponName" placeholder="Enter Coupon Name"
                        value="{{ isset($coupon->name) ? $coupon->name : '' }}" required>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group" id="coupon-limit-field">
                    <label for="coupon-limit">Usage Limit</label>
                    <input type="number" name="limit" class="form-control" id="coupon-limit-amount"
                        placeholder="Enter Coupon Limit" value="{{ (isset($coupon->limit) && $coupon->limit != -1) ? $coupon->limit : '' }}" required {{ (isset($coupon->limit) && $coupon->limit == -1) ? 'disabled' : '' }}>
                </div>
            </div>
            <div class="col-3">
                {{-- <div class="form-group">
                </div> --}}
                <div class="form-group clearfix">
                    <div class="icheck-primary mr-5" style="padding-top: 40px;">
                        {{-- {{!empty($coupon) && $coupon->infinte == 0 ? 'checked' : ''}} --}}
                        <input type="checkbox" id="checkbox-coupon-usage-limit" name="limit" value="-1" {{ (isset($coupon->limit) && $coupon->limit == -1) ? 'checked' : '' }}>
                        {{-- <label for="checkbox-coupon-usage-limit"></label> --}}
                        <label for="checkbox-coupon-usage-limit">No Limit</label>
                    </div>
                    {{-- <div class="icheck-primary mr-5">
                        <input type="checkbox" id="checkbox-coupon-availability" name="availability" value="1" checked>
                        <label for="checkbox-coupon-availability">Available Always</label>
                    </div> --}}
                </div>
            </div>
        </div>
        {{--
            |
            |   COUPON TYPE
            |
            --}}
        <div class="row">
            <div class="col-12">
                {{-- <div class="form-group" id="coupon-type-field">
                    <label for="coupon-type">Coupon Type</label>
                    <div class="select2-primary">
                        <select class="form-control select2" data-dropdown-css-class="select2-primary" data-placeholder="Select Coupon Type" name="type" required id="coupon_type">
                            <option value="">Please Select</option>
                            @foreach (config('default-data.coupon_type') as $couponType => $type)
                            <option value="{{$couponType}}" {{ ((!empty($coupon->type) && $coupon->type == $couponType)) ? 'selected' : '' }}>{{ ucfirst($type)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="form-group clearfix">
                    <label for="coupon-type">Coupon Type</label>
                </div>
                <div class="form-group clearfix">
                    @foreach (config('default-data.coupon_type') as $couponType => $type)
                    <div class="icheck-primary d-inline mr-5">
                        <input type="radio" id="coupon-type-{{$type}}" name="type" value="{{$couponType}}" class="radio-coupon-type" required  {{ ((!empty($coupon->type) && $coupon->type == $couponType)) ? 'checked' : '' }}>
                        <label for="coupon-type-{{$type}}">{{ucfirst($type)}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

         {{--
            |
            |   BOGO FIELDS
            |
            --}}
        <div class="row">
            <div class="col-3 d-none" id="bogo-fields">
                <div class="form-group">
                    <label for="coupon-bogo-buy-limit">Buy Limit</label>
                    <input type="number" name="buy_limit" class="form-control" placeholder="Enter Purchase Limit" value="{{ isset($coupon->buy_limit) ? $coupon->buy_limit : '' }}" >
                </div>
            </div>
            {{-- <div class="col-3">
                <div class="form-group">
                    <label for="coupon-bogo-get-select">Get</label>
                    <select class="form-control select2 charge-type" data-dropdown-css-class="select2-primary" name="charge_type" required style="width:100%">
                        @foreach (config('default-data.advance_charge_type') as $charge)
                            <option value="{{$charge}}" {{ ((!empty($coupon->charge_type) && $coupon->charge_type == $charge)) ? 'selected' : '' }}>{{ ucfirst(str_replace("_", " ", $charge))}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3 d-none" id="coupon-order-limi-field">
                <div class="form-group">
                    <label for="coupon-order-limit">Get Order Limit</label>
                    <input type="number" name="order_limit" class="form-control" id="coupon-order-limit" placeholder="Enter Order Limit" value="{{ isset($coupon->order_limit) ? $coupon->order_limit : '' }}">
                </div>
            </div> 
        </div>

         {{--
            |
            |   OTHER FIELDS
            |
            --}}
        {{-- <div class="row" id="other-coupon-fields"> --}}
            <div class="col-4">
                <div class="form-group">
                    <label for="coupon-other-limit">Provide</label>
                    <select class="form-control select2 charge-type" data-dropdown-css-class="select2-primary" name="charge_type" required style="width:100%">
                        @foreach (config('default-data.advance_charge_type') as $charge)
                            <option value="{{$charge}}" {{ ((!empty($coupon->charge_type) && $coupon->charge_type == $charge)) ? 'selected' : '' }}>{{ ucfirst(str_replace("_", " ", $charge))}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-2 d-none" id="coupon-order-limi-field">
                <div class="form-group">
                    <label for="coupon-order-limit">Get Order Limit</label>
                    <input type="number" name="order_limit" class="form-control" id="coupon-order-limit" placeholder="Enter Order Limit" value="{{ isset($coupon->order_limit) ? $coupon->order_limit : '' }}">
                </div>
            </div>
            <div class="col-2 d-none" id="coupon-assign-field">
                <div class="form-group">
                    <label for="coupon-order-limit">Assign Coupon</label>
                    <select class="form-control select2" data-dropdown-css-class="select2-primary" data-placeholder="Please Select" name="child_coupon" style="width:100%">
                        <option value=""">Please Select</option>
                        @foreach ($coupons as $cpn)
                        {{-- {{ ((!empty($coupon->coupon_id) && $cpn->id == $coupon->coupon_id)) ? 'selected' : '' }} --}}
                            <option value="{{$cpn->id}}">{{ $cpn->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group" id="coupon-max_discount-field">
                    <label for="coupon-max-discount">Max Discount</label>
                    <input type="number" name="max_discount" class="form-control" id="couponMaxDiscount"
                        placeholder="Enter Coupon Max Discount" step="0.01"
                        value="{{ isset($coupon->max_discount) ? $coupon->max_discount : '' }}" required>
                </div>
            </div>
            <div class="col-6" id="amount-div-field">
                <div class="form-group" id="coupon-amount-field">
                    <label for="coupon-amount" id="amount-label">Amount</label>
                    <input type="number" name="amount" class="form-control" id="couponAmount"
                        placeholder="Enter Coupon Amount" step="0.01" value="{{ isset($coupon->amount) ? $coupon->amount : '' }}">
                </div>
            </div>
        </div>

        {{--
            |
            |   USER LIMIT
            |
            --}}
        <div class="row">
            <div class="col-6">
                <div class="form-group" id="coupon-user-limit-field">
                    <label for="coupon-user-limit">Single User Limit</label>
                    <input type="number" name="per_user_limit" class="form-control" id="couponUserLimit" placeholder="Enter Coupon Per User Limit" value="{{ isset($coupon->per_user_limit) ? $coupon->per_user_limit : '' }}" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group" id="coupon-user-limit-day-field">
                    <label for="coupon-user-limit-day">Single User per day limit</label>
                    <input type="number" name="per_day_limit" class="form-control" id="couponUserLimit" placeholder="Enter Coupon User Limit Per Day" value="{{ isset($coupon->per_day_limit) ? $coupon->per_day_limit : '' }}" required>
                </div>
            </div>
        </div>

        {{--
            |
            |   AVAILABILITY
            |
            --}}
        <div class="row">
            <div class="col-6">
                <div class="form-group" id="service-description-field">
                    <label for="couponDescription">Description</label>
                    <textarea type="text" name="description" class="form-control" id="couponDescription"
                        placeholder="Enter Coupon Description" required>{{ isset($coupon->description) ? $coupon->description : '' }}</textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group clearfix">
                    <div class="icheck-primary d-inline mr-5">
                        <input type="checkbox" id="checkbox-coupon-availability" name="availability" value="1" {{(!empty($coupon) && $coupon->availability == 0) ? '' : 'checked'}}>
                        <label for="checkbox-coupon-availability">Available Always</label>
                    </div>
                </div>
            </div>
        </div>

        {{--
            |
            |   VALIDITY
            |
            --}}

        <span id="availability-valid" class="{{(!empty($coupon) && $coupon->availability == 0) ? '' : 'd-none'}}">
            <hr/>
            @php
                $dateTime = !empty($coupon->timing) ? json_decode($coupon->timing, true) : ""; 
                $couponTimeCount = !empty($dateTime) ? count($dateTime) : 1; 
            @endphp
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Validity</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                        </div>
                        <input type="text" class="form-control float-right" id="validity-time" name="date_time[0]" value="{{!empty($dateTime) ? $dateTime[0]['start_date'] . " - " . $dateTime[0]['end_date'] : ''}}">
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
            </div>

            {{--
                |
                |   DAYS FIELD
                |
                --}}
            <div class="row">
                <div class="col-12">
                    <div class="form-group" id="service-available-on-field">
                        <label for="couponAvailableOn">Available On</label>
                    </div>
                    <div class="form-group clearfix">
                        @foreach (config('default-data.days') as $day)
                            <div class="icheck-primary d-inline mr-5">
                                <input type="checkbox" id="checkbox-{{$day}}" name="days[0][]" value="{{!empty($dateTime) ? $dateTime[0]['days'] : ''}}" {{(!empty($coupon) && strpos($coupon, $day)) ? 'checked' : ''}}>
                                <label for="checkbox-{{$day}}">{{ucfirst($day)}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </span>

        <span id="more-validity-div">
            @if(!empty($dateTime))
            @foreach ($dateTime as $d => $item)
            @if($d == 0) @continue @endif
                <span class="validity-clone-{{$d}}">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Validity</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control float-right validity-mulitple-time" id="validity-time-{{$d}}" name="date_time[{{$d}}]" value="{{!empty($dateTime) ? $dateTime[$d]['start_date'] . " - " . $dateTime[$d]['end_date'] : ''}}">
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-1">
                            <i class="fas fa-times-circle text-danger float-right pt-5 delete-clone" role="button" data-delete-clone="validity-clone-{{$d}}"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group" id="service-description-field">
                                <label for="couponDescription">Available On</label>
                            </div>
                            <div class="form-group clearfix">
                                @php $itemDays = explode(",", $item['days']) @endphp
                                @foreach (config('default-data.days') as $day)
                                    <div class="icheck-primary d-inline mr-5">
                                        <input type="checkbox" id="checkbox-{{$day}}-{{$d}}" name="days[{{$d}}][]" value="{{$day}}" {{(!empty($item['days']) && in_array($day, $itemDays)) ? 'checked' : ''}}>
                                        <label for="checkbox-{{$day}}-{{$d}}">{{ucfirst($day)}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </span>
            @endforeach
            @endif
        </span>

        <div class="row py-3 {{(!empty($coupon) && $coupon->availability == 0) ? '' : 'd-none'}}" id="add-more-validity-btn-field">
            <div class="col-12">
                <button type="button" class="btn btn-block btn-outline-secondary col-3 float-right" id="add-new-validity-btn">
                    <i class="fas fa-plus-circle"></i> Add More
                </button>
            </div>
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <div class="row">
                <div class="col-12">
                    <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                    <input type="submit" value="Save" class="btn btn-primary float-right">
                </div>
            </div>
        </div>
    </div>

    <!-- /.card-body -->
</form>

@once
    @push('custom_scripts')
    <!-- InputMask -->
        <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
        <script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
        <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
        <script>
        //Date range picker with time picker
            $('#validity-time').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            });
            $('.validity-mulitple-time').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            });
            $(document).ready(function() {
                $(".select2").select2();
                // $("#coupon_type").on('change', function(){
                $(".charge-type").on('change', function(){
                    if($(this).val() == "order_limit"){
                        $("#coupon-order-limi-field").removeClass('d-none');
                        $("#coupon-assign-field").addClass('d-none');
                    }else if($(this).val() == "coupon"){
                        $("#coupon-assign-field").removeClass('d-none');
                        $("#coupon-order-limi-field").addClass('d-none');
                    }else if($(this).val() == "flat" || $(this).val() == 'percentage'){
                        $("#amount-div-field").removeClass('d-none');
                        $("#coupon-order-limi-field").addClass('d-none');
                        $("#coupon-assign-field").addClass('d-none');
                    }else{
                        $("#coupon-order-limi-field").addClass('d-none');
                        $("#coupon-assign-field").addClass('d-none');
                        $("#amount-div-field").addClass('d-none');
                    }
                    if($(this).val() == 'percentage'){
                        $("#amount-label").html('Percentage');
                    }else{
                        $("#amount-label").html('Amount');
                    }
                });
                
                $(".radio-coupon-type").on('click', function(){

                    if($(this).val() == "bogo"){
                        $("#bogo-fields").removeClass('d-none');
                    }else{
                        $("#bogo-fields").addClass('d-none');
                    }
                });

                $("#checkbox-coupon-usage-limit").on('click', function(){
                    if($(this).is(":checked")){
                        $("#coupon-limit-amount").prop('disabled', true);
                    }else{
                        $("#coupon-limit-amount").prop('disabled', false);
                    }
                })

                $("#checkbox-coupon-availability").on('click', function(){
                    if($(this).is(":checked")){
                        $("#availability-valid").addClass("d-none");
                        $("#add-more-validity-btn-field").addClass("d-none");
                    }else{
                        $("#availability-valid").removeClass("d-none");
                        $("#add-more-validity-btn-field").removeClass("d-none");
                    }
                });

                let validity = "{{$couponTimeCount}}";
                $('#add-new-validity-btn').on('click', function(){
                    $("#more-validity-div").append(`
                        <span class="validity-clone-`+validity+`">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Validity</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="validity-time-`+validity+`" name="date_time[`+validity+`]">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-1">
                                    <i class="fas fa-times-circle text-danger float-right pt-5 delete-clone" role="button" data-delete-clone="validity-clone-`+validity+`"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group" id="service-description-field">
                                        <label for="couponDescription">Available On</label>
                                    </div>
                                    <div class="form-group clearfix">
                                        @foreach (config('default-data.days') as $day)
                                            <div class="icheck-primary d-inline mr-5">
                                                <input type="checkbox" id="checkbox-{{$day}}-`+validity+`" name="days[`+validity+`][]" value="{{$day}}">
                                                <label for="checkbox-{{$day}}-`+validity+`">{{ucfirst($day)}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </span>
                    `);
                    $('#validity-time-'+validity).daterangepicker({
                        timePicker: true,
                        timePickerIncrement: 30,
                        locale: {
                            format: 'MM/DD/YYYY hh:mm A'
                        }
                    });
                    validity++;
                });
            });
        </script>
    @endpush
@endonce
