@push('custom_head')
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush

<form action="{{ !empty($couponCode) ? route('admin.coupon.code.update') : route('admin.coupon.code.save') }}"
    method="post" enctype="multipart/form-data">
    <div class="card-body">
        @csrf
        @if (!empty($couponCode))
            <input type="hidden" name="id" value="{{ $couponCode->id }}" />
        @endif

        <div class="row">
            <div class="col-3">
                <div class="form-group" id="coupon-prefix">
                    <label for="coupon-prefix">Prefix</label>
                    {{-- <div class="input-group mb-3"> --}}
                    <input type="text" type="text" name="coupon_prefix" class="form-control"
                        value="{{ !empty($couponCode) ? $couponCode->coupon_prefix : '' }}" pattern="[A-Za-z0-9]+"
                        placeholder="AbC">
                    {{-- <div class="input-group-append" role="button" title="Generate Coupon" id='generate-coupon-btn'>
                          <span class="input-group-text"><i class="fas fa-pen" title="Generate Coupon" role="button"></i></span>
                        </div> --}}
                    {{-- </div> --}}
                </div>
            </div>
            <div class="col-3">
                <div class="form-group" id="coupon-code-field">
                    <label for="coupon-code-field">Code</label>
                    {{-- <div class="input-group mb-3"> --}}
                    <input type="text" type="text" name="coupon_code" class="form-control" readonly
                        value="{{ !empty($couponCode) ? $couponCode->coupon_code : $code }}">
                    {{-- <div class="input-group-append" role="button" title="Generate Coupon" id='generate-coupon-btn'>
                          <span class="input-group-text"><i class="fas fa-pen" title="Generate Coupon" role="button"></i></span>
                        </div> --}}
                    {{-- </div> --}}
                </div>
            </div>

            <div class="col-6" id="coupon-field">
                <div class="form-group">
                    <label for="coupon-field">Coupons</label>
                    <div class="select2-primary">
                        <select class="form-control select2 select2-hidden-accessible" name="coupon_id"
                            data-placeholder="Select Coupon" data-dropdown-css-class="select2-primary"
                            style="width: 100%;" aria-hidden="true" required>
                            <option value="">Please Select</option>
                            @foreach ($coupons as $coupon)
                                <option value="{{ $coupon->id }}" {{ (!empty($couponCode) && $couponCode->coupon_id == $coupon->id) ? 'selected' : '' }}> {{ $coupon->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="coupon-url">Url</label>
                    <input type="url" name="url" class="form-control" id="coupon-url"
                        placeholder="Example: https://example.com/"
                        value="{{ !empty($couponCode) ? $couponCode->url : '' }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group clearfix">
                    <div class="icheck-primary d-inline mr-5">
                        <input type="radio" id="for-user" name="assign_to" value="for_user" class="radio-assign-to"
                            required>
                        <label for="for-user">Assign Code to User</label>
                    </div>
                    <div class="icheck-primary d-inline">
                        <input type="radio" id="for-branch" name="assign_to" value="for_branh" class="radio-assign-to"
                            required>
                        <label for="for-branch">Assign Code to Branch</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 d-none" id="user-field">
                <div class="form-group">
                    <label for="user">Assign to User(s)</label>
                    <div class="select2-primary">
                        <select class="form-control select2 select2-hidden-accessible search-user" multiple
                            name="user_ids[]" data-placeholder="Select User(s)"
                            data-dropdown-css-class="select2-primary" style="width: 100%;" aria-hidden="true">
                            <option value="">Please Select</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-6 d-none" id="branch-field">
                <div class="form-group">
                    <label for="branch">Assign to Branch(es)</label>
                    <div class="select2-primary">
                        <select class="form-control select2 select2-hidden-accessible search-branch" multiple
                            name="branch_ids[]" data-placeholder="Select Branch(es)"
                            data-dropdown-css-class="select2-primary" style="width: 100%;" aria-hidden="true">
                            <option value="">Please Select</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <div class="icheck-primary d-inline">
                        <input type="checkbox" id="overwrite-fields-checkbox" name="overwrite" value="1"
                            {{ !empty($couponCode) && $couponCode->user_coupon_amount == 0 ? 'checked' : '' }}>
                        <label for="overwrite-fields-checkbox">
                            Overwrite Coupon Info
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row {{ !empty($couponCode) && $couponCode->user_coupon_amount == 0 ? '' : 'd-none' }}"
            id="overwrite-fields">
            <div class="col-6">
                <div class="form-group">
                    <label for="coupon-limit">Usage Limit</label>
                    <input type="number" min="1" name="limit" class="form-control" id="coupon-limit"
                        placeholder="Enter Coupon Limit" value="{{ !empty($couponCode) ? $couponCode->limit : '' }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group" id="charge-field">
                    <label for="charge-type">Charge Type</label>
                    <select class="form-control select2" data-dropdown-css-class="select2-primary" name="charge_type"
                        style="width: 100%;">
                        @foreach (config('default-data.advance_charge_type') as $charge)
                            <option value="{{ $charge }}"
                                {{ !empty($couponCode) && $couponCode->charge_type == $charge ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $charge)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group" id="coupon-amount-field">
                    <label for="coupon-amount" id="amount-label">Amount</label>
                    <input type="number" name="amount" step="0.01" class="form-control" id="couponAmount"
                        placeholder="Enter Coupon Amount"
                        value="{{ !empty($couponCode) ? $couponCode->amount : '' }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Validity</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                        </div>
                        <input type="text" class="form-control float-right" id="reservationtime" name="date_time"
                            {{ !empty($couponCode) ? $couponCode->start_date . ' - ' . $couponCode->end_date : '' }}>
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-12">
                    <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                    <input type="submit" value="Save" class="btn btn-primary float-right">
                </div>
            </div>
        </div>
    </div>
</form>


@once
    @push('custom_scripts')
        <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
        <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script>
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            });
            $(document).ready(function() {

                $('.radio-assign-to').on('click', function() {
                    if ($(this).val() == 'for_user') {
                        $("#user-field").removeClass('d-none');
                        $("#branch-field").addClass('d-none');
                    } else {
                        $("#branch-field").removeClass('d-none');
                        $("#user-field").addClass('d-none');
                    }
                });

                $("#generate-coupon-btn").on('click', function() {

                });

                $("#overwrite-fields-checkbox").on('click', function() {
                    if ($(this).is(':checked')) {
                        $("#overwrite-fields").removeClass('d-none');
                    } else {
                        $("#overwrite-fields").addClass('d-none');
                    }
                });

                $('.search-user').select2();
                $('.search-user').select2({
                    ajax: {
                        url: "{{ route('helper.user') }}",
                        dataType: "json",
                        data: function(params) {
                            return {
                                search: params.term, // search term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.result
                            }
                        }
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
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.result
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
@endonce
