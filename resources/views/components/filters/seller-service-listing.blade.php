<form method="get">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="sub-category">Platforms</label>
                    <select class="form-control select2" multiple name="platform_ids[]" style="width: 100%;" data-placeholder="Please Select">
                        <option value="" disabled>Please Select</option>
                        @foreach ($platforms as $platform)
                            <option value="{{ $platform->id }}" {{ !empty(request()->get('platform_ids')) && in_array($platform->id, request()->get('platform_ids')) ? 'selected' : '' }}>
                                {{ $platform->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="sub-category">Categories</label>
                    <select class="form-control select2" multiple name="category_ids[]" style="width: 100%;" data-placeholder="Please Select">
                        <option value="" disabled>Please Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ !empty(request()->get('category_ids')) && in_array($category->id, request()->get('category_ids')) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="sub-category">Status</label>
                    <select class="form-control select2" multiple name="status[]" style="width: 100%;" data-placeholder="Please Select">
                        <option value="" disabled>Please Select</option>
                        @foreach (config('default-data.statuses') as $constant => $status)
                            <option value="{{ $constant }}" {{ !empty(request()->get('status')) && in_array($constant, request()->get('status')) ? 'selected' : "" }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-12">
                <a href="{{ url()->current() }}" class="btn btn-outline-secondary">Clear Filters</a>
                <input type="submit" value="Search" class="btn btn-primary float-right">
            </div>
        </div>
    </div>
</form>
