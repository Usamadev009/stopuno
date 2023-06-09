@extends('auth')

@section('auth_content')
<p class="login-box-msg h4">Sign in</p>

<form action="{{route('authenticate')}}" method="post">
    @csrf
    <div class="input-group mb-3">
        <input name="email" type="email" class="form-control" placeholder="Email" value="{{request()->old('email')}}" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input name="password" type="password" class="form-control" placeholder="Password" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            <button type="submit" class="btn btn-danger btn-block">Sign In</button>
        </div>
    </div>
</form>
@endsection
