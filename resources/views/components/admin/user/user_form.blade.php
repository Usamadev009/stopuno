<form class="form-horizontal" method="POST" action="{{ route('admin.user.save.official') }}">
    @csrf
    <div class="card-body">
        @if (!empty($user))
            <input type="hidden" name="id" value="{{ $user->id }}" />
        @endif
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" value="{{ !empty($user) ? $user->name : '' }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="{{ !empty($user) ? $user->email : '' }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>
                        <input type="text" class="form-control" id="inputName2" placeholder="Name" name="phone" value="{{ !empty($user) ? $user->phone : '' }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="inputName2" class="col-sm-2 col-form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Name" name="password" value="{{ !empty($user) ? $user->phone : '' }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="sub-service">Roles</label>
                    <select class="form-control select2" multiple name="roles[]" style="width: 100%;" data-placeholder="Please Select">
                        <option value="">Please Select</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->title }}
                            </option>
                        @endforeach
                    </select>
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
    </div>
</form>
