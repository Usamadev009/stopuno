<form class="form-horizontal" method="POST" action="{{ route('admin.user.update') }}">
    @csrf
    @if (!empty($user))
        <input type="hidden" name="id" value="{{ $user->id }}" />
    @endif
    <div class="form-group row">
        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" placeholder="Name" name="name"
                value="{{ !empty($user) ? $user->name : '' }}">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email"
                value="{{ !empty($user) ? $user->email : '' }}">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName2" placeholder="Name" name="phone"
                value="{{ !empty($user) ? $user->phone : '' }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-danger">Submit</button>
        </div>
    </div>
</form>
