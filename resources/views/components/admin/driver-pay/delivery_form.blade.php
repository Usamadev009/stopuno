<form action="{{(!empty($driverPay)) ? route('admin.driver.update') : route('admin.driver.save')}}" method="post" enctype="multipart/form-data">
    <div class="card-body">
        @csrf
        @if(!empty($driverPay))
            <input type="hidden" name="id" value="{{$driverPay->id}}" />
        @endif
        <div class="row">
            <div class="col-6" id="serivce-field">
                <div class="form-group">
                    <label for="serivce">Services</label>
                    <div class="select2-primary">
                        <select class="form-control select2 select2-hidden-accessible" {{!empty($driverPay) ? '' : 'multiple'}} name="service_ids[]" data-placeholder="Select Services" data-dropdown-css-class="select2-primary" style="width: 100%;" aria-hidden="true" required>
                            <option value="">Please Select</option>
                            @foreach ($services as $service)
                                <option value="{{$service->id}}" {{ (!empty($driverPay->service_id) && $driverPay->service_id == $service->id) ? 'selected' : '' }}>{{$service->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group" id="charge-field">
                    <label for="charge-type">Charge Type</label>
                    <select class="form-control select2" data-dropdown-css-class="select2-primary" name="charge_type" required>
                        @foreach (config('default-data.charge_type') as $charge)
                            <option value="{{$charge}}" {{ (!empty($driverPay->charge_type) && $driverPay->charge_type == $charge) ? 'selected' : '' }}>{{ ucfirst($charge)}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6" id="base-pay-field">
                <div class="form-group">
                    <label for="base-pay">Base Pay</label>
                    <input type="number" name="base_pay" min="0.00" step="0.00" class="form-control" id="base-pay" placeholder="Enter Base Pay" value="{{ !empty($driverPay->base_pay) ? $driverPay->base_pay : '' }}" required>
                </div>
            </div>
            <div class="col-6" id="min-pay-field">
                <div class="form-group">
                    <label for="min-pay">Minimum Pay</label>
                    <input type="number" name="min_pay" min="0.00" step="0.00" class="form-control" id="min-pay" placeholder="Enter Minimum Pay" value="{{ !empty($driverPay->min_pay) ? $driverPay->min_pay : '' }}" required>
                </div>
            </div>
        </div>
        <hr/>
        @php
            $distance = !empty($driverPay->distance) ? json_decode($driverPay->distance, true) : "";
            $distCount = !empty($distance) ? count($distance) : 1;
        @endphp
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="distance">Distance (Minimum : Maximum )</label>
                    <div class="slider-blue">
                      <input type="text" value="{{!empty($distance) ? $distance[0]['min_distance'] : '0'}},{{!empty($distance) ? $distance[0]['max_distance'] : '3'}}" name="distance[0][value]" class="slider form-control" data-slider-min="0" data-slider-max="100"
                           data-slider-step="0.01" data-slider-value="[{{!empty($distance) ? $distance[0]['min_distance'] : '0'}},{{!empty($distance) ? $distance[0]['max_distance'] : '3'}}]" data-slider-orientation="horizontal"
                           data-slider-selection="before" data-slider-tooltip="show">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="distance">Amount</label>
                    <input type="number" name="distance[0][amount]" min="0.00" step="0.00" class="form-control" id="dist-amount" placeholder="Enter Distance Amount" value="{{!empty($distance) ? $distance[0]['amount'] : '0'}}" required>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <div class="form-group">
                    <div class="icheck-primary d-inline">
                        <input type="checkbox" id="distance-recursive-checkbox" name="recursive" value="1" >
                        <label for="distance-recursive-checkbox">
                            Making The Distance Recursive
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div id="more-distance">
            @if(!empty($distance))
            @foreach ($distance as $d => $item)
            @if($d == 0) @continue @endif
                <div class="row distance-clone-{{$d}}">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="distance">Distance (Minimum : Maximum )</label>
                            <div class="slider-blue">
                            <input type="text" value="{{!empty($item) ? $item['min_distance'].','.$item['max_distance'] : '' }}" name="distance[{{$d}}][value]" class="slider form-control" data-slider-min="0" data-slider-max="100"
                                data-slider-step="0.01" data-slider-value="[{{!empty($item) ? $item['min_distance'] : '0'}},{{!empty($item) ? $item['max_distance'] : '3'}}]" data-slider-orientation="horizontal"
                                data-slider-selection="before" data-slider-tooltip="show">
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="distance">Amount</label>
                            <input type="number" name="distance[{{$d}}][amount]" min="0.00" step="0.00" class="form-control" placeholder="Enter Distance Amount" value="{{ !empty($item) ? $item['amount'] : ''}}">
                        </div>
                    </div>
                    <div class="col-1">
                        <i class="fas fa-times-circle text-danger float-right pt-5 delete-clone" role="button" data-delete-clone="distance-clone-{{$d}}"></i>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <button type="button" class="btn btn-block btn-outline-secondary float-right col-3" id="add-new-distance-btn">
                    <i class="fas fa-plus-circle"></i> Add More
                </button>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                
                <input type="submit" value="Save" class="btn btn-primary float-right">
            </div>
        </div>
    </div>

    <!-- /.card-body -->
</form>

@once
    @push('custom_scripts')
        <script>
            $(document).ready(function(){
                $('.slider').bootstrapSlider()

                let distance = "{{$distCount}}";
                $('#distance-recursive-checkbox').on('click', function(){
                    if ($(this).is(':checked')) {
                        $("#more-distance").addClass('d-none');
                        $("#add-new-distance-btn").addClass('d-none');
                    } else {
                        $("#more-distance").removeClass('d-none');
                        $("#add-new-distance-btn").removeClass('d-none');
                    }
                });

                $('#add-new-distance-btn').on('click', function(){
                    $("#more-distance").append(`
                        <div class="row distance-clone-`+distance+`">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="distance">Distance (Minimum : Maximum )</label>
                                    <div class="slider-blue">
                                    <input type="text" value="" name="distance[`+distance+`][value]" class="slider-`+distance+` form-control" data-slider-min="0" data-slider-max="100"
                                        data-slider-step="0.01" data-slider-value="[0,3]" data-slider-orientation="horizontal"
                                        data-slider-selection="before" data-slider-tooltip="show">
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="distance">Amount</label>
                                    <input type="number" name="distance[`+distance+`][amount]" min="0.00" step="0.00" class="form-control" placeholder="Enter Distance Amount" value="">
                                </div>
                            </div>
                            <div class="col-1">
                                <i class="fas fa-times-circle text-danger float-right pt-5 delete-clone" role="button" data-delete-clone="distance-clone-`+distance+`"></i>
                            </div>
                        </div>
                    `);
                    $('.slider-'+distance).bootstrapSlider()
                    distance++;
                });
            });

        </script>
    @endpush
@endonce
