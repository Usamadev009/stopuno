@push('custom_head')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush
<form action="{{ !empty($subscription) ? route('admin.subscription.update') : route('admin.subscription.save') }}"
    method="post" enctype="multipart/form-data">
    <div class="card-body">
        @csrf
        @if (!empty($subscription))
            <input type="hidden" name="id" value="{{ $subscription->id }}" />
        @endif
        <div class="row">
            <div class="col-6">
                <div class="form-group" id="subscription-name-field">
                    <label for="subscriptionName">Title</label>
                    <input type="text" name="name" class="form-control" id="subscriptionName"
                        placeholder="Enter Subscription Name"
                        value="{{ isset($subscription->name) ? $subscription->name : '' }}" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="sub-subscription">Currency</label>
                    <select class="form-control select2" name="currency" style="width: 100%;" required>
                        {{-- <option value="">Please Select</option>
                        @foreach ($parentsubscription as $parent) --}}
                        <option value="usd">USD</option>
                        {{-- @endforeach --}}
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="subscriptionFee">Fee</label>
                    <input type="number" step="0.01" min="0" name="price" class="form-control"
                        id="subscription-fee" required
                        value="{{ !empty($subscription) ? $subscription->price : '' }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="sub-subscription">Charge Interval</label>
                    <select class="form-control select2" name="interval" style="width: 100%;" required
                        aria-placeholder="Please Select" required>
                        <option value="">Please Select</option>
                        @foreach (config('default-data.interval') as $index => $type)
                            <option value="{{ $index }}"
                                {{ !empty($subscription->interval) && $subscription->interval == $index ? 'selected' : '' }}>
                                {{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="sub-category">Platform</label>
                    <select class="form-control select2" name="platform_id" style="width: 100%;">
                        <option value="">Please Select</option>
                        @foreach ($platforms as $platform)
                            <option value="{{ $platform->id }}"
                                {{ !empty($category) && $category->platform_id == $platform->id ? 'selected' : '' }}>
                                {{ $platform->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="subscription-description">Description</label>
                    <textarea name="description" class="form-control" id="subscription-description">{!! !empty($subscription->description) ? $subscription->description : '' !!}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <div class="btn btn-default btn-file">
                        <i class="fas fa-image"></i> <span class="h5">Image</span>
                        <input type="file" name="image" id="upload-image" accept="image/*">
                    </div>
                    <p class="help-block">Max. 5MB</p>
                </div>
            </div>
            <div class="col-6 {{ !empty($subscription->image) ? '' : 'd-none' }}" id="image-display">
                @if (!empty($subscription->image))
                    <img class="img-fluid" src="{{ asset($subscription->image) }}" alt="img"
                        style="max-height:200px; max-width=" 100px">
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
        <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
        <script>
            $(function() {
                // Summernote
                $('#subscription-description').summernote()
            })

            $(document).ready(function() {});
        </script>
    @endpush
@endonce
