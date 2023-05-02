<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BootstrapDash Wizard</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('registerform/css/bd-wizard.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- pace-progress -->
    <link rel="stylesheet" href="{{ asset('plugins/pace-progress/themes/black/pace-theme-flat-top.css') }}">
    <!-- Bootstrap slider -->
    <script src="{{ asset('plugins/bootstrap-slider/bootstrap-slider.min.js') }}"></script>
    <!-- adminlte-->
    {{-- <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

</head>

<body>
    <main class="my-5">
        <div class="container">
            <div id="wizard">
                <h3>
                    <div class="media">
                        <div class="bd-wizard-step-icon"><i class="mdi mdi-account-outline"></i></div>
                        <div class="media-body">
                            <div class="bd-wizard-step-title">Basic Info</div>
                            {{-- <div class="bd-wizard-step-subtitle">Step 1</div> --}}
                        </div>
                    </div>
                </h3>
                <section>
                    <div class="content-wrapper">
                        {{-- <h4 class="section-heading">Enter your Branch details </h4> --}}
                        <h4 class="section-heading"></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter Branch Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="Enter Branch Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phoneNumber">Phone Number</label>
                                    <input type="text" name="number" id="number" class="form-control"
                                        placeholder="Enter Branch Number">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="sub-category">Service</label>
                                    <select class="form-control select2" name="service_id" style="width: 100%;">
                                        <option value="">Please Select</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}"
                                                {{ !empty($category) && $category->service_id == $service->id ? 'selected' : '' }}>
                                                {{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6" id="sub-category-field">
                                <div class="form-group">
                                    <label for="sub-category">Parent category</label>
                                    <select class="form-control select2" name="category_id" style="width: 100%;">
                                        <option value="">Please Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ !empty($category->parent_id) && $category->parent_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Branch Services</label>
                                    <select name="branch_services" class="select2" multiple="multiple"
                                        data-placeholder="Select a State" style="width: 100%;">
                                        @foreach (config('default-data.branch_services') as $branchService)
                                            <option value="{{ $branchService }}"
                                                {{ !empty($delivery->branch_service) && $delivery->branch_service == $branchService ? 'selected' : '' }}>
                                                {{ ucfirst($branchService) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @php
                            $distance = !empty($delivery->distance) ? json_decode($delivery->distance, true) : '';
                            $distCount = !empty($distance) ? count($distance) : 1;
                        @endphp
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="distance">Distance (Minimum : Maximum )</label>
                                    <div class="slider-blue">
                                        <input type="text" value="0,3" name="distance[0][value]"
                                            class="slider form-control" data-slider-min="0" data-slider-max="100"
                                            data-slider-step="0.01" data-slider-value="[0,3]"
                                            data-slider-orientation="horizontal" data-slider-selection="before"
                                            data-slider-tooltip="show">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="preparedTime">Prepared Time (In Minutes)</label>
                                    <input type="number" name="prepared_time" id="preparedTime" class="form-control"
                                        placeholder="Enter Prepared Time">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="btn btn-default btn-file">
                                        <i class="fas fa-image"></i> <span class="h5">Image</span>
                                        <input type="file" name="branch_image" id="upload-image"
                                            accept="image/*">
                                    </div>
                                    <p class="help-block">Max. 5MB</p>
                                </div>
                            </div>
                            <div class="col-6 {{ !empty($branch->image) ? '' : 'd-none' }}" id="image-display">
                                @if (!empty($branch->image))
                                    <img class="img-fluid" src="{{ asset($branch->image) }}" alt="img"
                                        style="max-height:200px; max-width: 100px">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="btn btn-default btn-file">
                                        <i class="fas fa-image"></i> <span class="h5">Banner</span>
                                        <input type="file" name="branch_banner" id="upload-banner"
                                            accept="image/*">
                                    </div>
                                    <p class="help-block">Max. 5MB</p>
                                </div>
                            </div>
                            <div class="col-6 {{ !empty($branch->banner) ? '' : 'd-none' }}" id="banner-display">
                                @if (!empty($branch->banner))
                                    <img class="img-fluid" src="{{ asset($branch->banner) }}" alt="img"
                                        style="max-height:200px; max-width:100px">
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
                <h3>
                    <div class="media">
                        <div class="bd-wizard-step-icon"><i class="mdi mdi-bank"></i></div>
                        <div class="media-body">
                            <div class="bd-wizard-step-title">Questionnair</div>
                            {{-- <div class="bd-wizard-step-subtitle">Step 2</div> --}}
                        </div>
                    </div>
                </h3>
                <section>
                    <div class="content-wrapper">
                        {{-- <h4 class="section-heading">Enter your Employment details </h4> --}}
                        <div class="card-header">
                            <h3 class="card-title">Questionnair</h3>
                        </div>
                        <div class="card-body">
                            {{-- <div class="row"> --}}
                            @if (!empty($services[0]->question) && count(json_decode($services[0]->question, true)) > 0)
                                @foreach (json_decode($services[0]->question, true) as $q => $question)
                                    @php $countQ = count(json_decode($services[0]->question, true)); @endphp
                                    <div class="row question-clone-exist-{{ $q }}">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="question-desc">{{ $question['description'] }}</label>
                                                <input type="text" name="q[{{ $q }}]"
                                                    class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="question-type">{{ $question['type'] }}</label>
                                                <select class="form-control select2"
                                                    name="questions[{{ $q }}][type]" style="width: 100%;">
                                                    <option value="">Please Select</option>
                                                    @foreach (config('default-data.question_types') as $type => $display)
                                                        <option value="{{ $type }}"
                                                            {{ $type == $question['type'] ? 'selected' : '' }}>
                                                            {{ $display }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            {{-- </div> --}}
                        </div>
                    </div>
                </section>
                <h3>
                    <div class="media">
                        <div class="bd-wizard-step-icon"><i class="mdi mdi-account-check-outline"></i></div>
                        <div class="media-body">
                            <div class="bd-wizard-step-title">Terms & Conditions </div>
                            {{-- <div class="bd-wizard-step-subtitle">Step 3</div> --}}
                        </div>
                    </div>
                </h3>
                <section>
                    <div class="content-wrapper">
                        <h4 class="section-heading mb-5">Accept agreement and Submit</h4>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="" id=""
                                    value="checkedValue" checked>
                                I hereby declare that I had read all the <a href="#!">terms and conditions</a> and
                                all the details provided my me in this form are true.
                            </label>
                        </div>
                    </div>
                </section>
                <h3>
                    <div class="media">
                        <div class="bd-wizard-step-icon"><i class="mdi mdi-emoticon-outline"></i></div>
                        <div class="media-body">
                            <div class="bd-wizard-step-title">Submit</div>
                            {{-- <div class="bd-wizard-step-subtitle">Step 4</div> --}}
                        </div>
                    </div>
                </h3>
                <section>
                    {{-- <div class="content-wrapper">
                        <h4 class="section-heading mb-5">Accept agreement and Submit</h4>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="" id=""
                                    value="checkedValue" checked>
                                I hereby declare that I had read all the <a href="#!">terms and conditions</a> and
                                all the details provided my me in this form are true.
                            </label>
                        </div>
                    </div> --}}
                </section>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('registerform/js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('registerform/js/bd-wizard.js') }}"></script>
    <!-- Bootstrap slider -->
    <script src="{{ asset('plugins/bootstrap-slider/bootstrap-slider.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- pace-progress -->
    <script src="{{ asset('plugins/pace-progress/pace.min.js') }}"></script>
    {{-- CUSTOM GENERIC JS --}}
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
    @once
        @push('custom_scripts')
            <script>
                $(document).ready(function() {
                    // UPLOAD SINGLE BANNER
                    $("#upload-banner").on('change', function(e) {
                        $("#banner-display").html("");
                        if (e.target.files[0].type.includes('image') && e.target.files[0].size >= 5000000) {
                            alert('Banner Size should upto 5Mb');
                            return false;
                        }

                        if (e.target.files[0].type.includes('image')) {
                            $("#banner-display").append(`<img class="img-fluid" src="` + URL.createObjectURL(e
                                    .target.files[0]) +
                                `" alt="banner" style="max-height:200px; max-width="100px">`);
                        }
                        $("#banner-display").removeClass("d-none");
                    });
                });
            </script>
        @endpush
    @endonce
</body>

</html>
