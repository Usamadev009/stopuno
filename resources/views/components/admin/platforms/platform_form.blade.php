<form action="{{ !empty($platform) ? route('admin.platforms.update') : route('admin.platforms.save') }}" method="post"
    enctype="multipart/form-data">
    <div class="card-body">
        @csrf
        @if (!empty($platform))
            <input type="hidden" name="id" value="{{ $platform->id }}" />
        @endif
        @if (isset($platform->module) && empty($platform->module))
            <div class="row d-none">
                <div class="col-6">
                    <div class="form-group">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" id="sub-platform-checkbox" name="sub_platform" value="1"
                                checked>
                            <label for="sub-platform-checkbox">
                                Sub Platform
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-6">
                <div class="form-group" id="platform-name-field">
                    <label for="platformName">Title</label>
                    <input type="text" name="name" class="form-control" id="platformName"
                        placeholder="Enter Platform Name" value="{{ isset($platform->name) ? $platform->name : '' }}"
                        required>
                </div>
            </div>
            @if (!isset($platform->module) || empty($platform->module))
                {{-- <div class="col-6 {{ !empty($platform) && !empty($platform->parent_id) ? '' : 'd-none' }}"> --}}
                <div class="col-6" id="sub-platform-field">
                    <div class="form-group">
                        <label for="sub-platform">Sub Platform of</label>
                        <select class="form-control select2" name="parent_id" style="width: 100%;" required>
                            <option value="">Please Select</option>
                            @foreach ($parentPlatform as $parent)
                                <option value="{{ $parent->id }}"
                                    {{ !empty($platform->parent_id) && $platform->parent_id == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="platformColor">Platform Fee</label>
                    <input type="number" step="0.01" min="0" name="fee" class="form-control"
                        id="platform-fee" value="{{ !empty($platform) ? $platform->fee : '' }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="platformColor">Color</label>
                    <input type="color" name="color" class="form-control" id="platformColor"
                        value="{{ !empty($platform) ? $platform->color : '#dc3545' }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="platform-business-type">Business Type</label>
                    <select class="form-control select2" name="business_type" style="width: 100%;" required>
                        <option value="">Please Select</option>
                        <option value="1"
                            {{ !empty($platform->business_type) && $platform->business_type == 1 ? 'selected' : '' }}>
                            Individual </option>
                        <option value="2"
                            {{ !empty($platform->business_type) && $platform->business_type == 2 ? 'selected' : '' }}>
                            Company </option>
                        <option value="3"
                            {{ !empty($platform->business_type) && $platform->business_type == 3 ? 'selected' : '' }}>
                            Both </option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="platform-ein">EIN must be Unique</label>
                    <select class="form-control select2" name="ein_required" style="width: 100%;" required>
                        <option value="0"
                            {{ !empty($platform) && $platform->ein_required == 0 ? 'selected' : '' }}> No </option>
                        <option value="1"
                            {{ !empty($platform) && $platform->ein_required == 1 ? 'selected' : '' }}> Yes </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="platform-description">Description</label>
                    <textarea name="description" class="form-control" id="platform-description">{!! !empty($platform->description) ? $platform->description : '' !!}</textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="platform-tnc">Terms And Conditions</label>
                    <textarea name="terms_description" class="form-control" id="platform-tnc">{!! !empty($platform->terms_description) ? $platform->terms_description : '' !!}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <div class="btn btn-default btn-file">
                        <i class="fas fa-image"></i> <span class="h5">Image</span>
                        <input type="file" name="platform_image" id="platformImg" accept="image/*">
                    </div>
                    <p class="help-block">Max. 5MB</p>
                </div>
            </div>
            <div class="col-6 {{ !empty($platform->image) ? '' : 'd-none' }}" id="image-display">
                @if (!empty($platform->image))
                    <img class="img-fluid" src="{{ asset($platform->image) }}" alt="img"
                        style="max-height:200px; max-width:100px">
                @endif
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

</form>

{{-- @once
    @push('custom_scripts')
        <script>
            $(document).ready(function() {
                $('.select2').select2()

                $("#platformImg").on('change', function(e) {
                    $("#image-display").html("");
                    for (var i = 0; i < e.target.files.length; i++) {
                        if (e.target.files[i].type.includes('image') && e.target.files[i].size >= 5000000) {
                            alert('Image Size should upto 5Mb');
                            return false;
                        }

                        if (e.target.files[i].type.includes('image')) {
                            $("#image-display").append(`<img class="img-fluid" src="` + URL.createObjectURL(e
                                    .target.files[i]) +
                                `" alt="img" style="max-height:200px; max-width="100px">`);
                        }

                    }
                    $("#image-display").removeClass("d-none");
                });
            });
        </script>
    @endpush
@endonce --}}
