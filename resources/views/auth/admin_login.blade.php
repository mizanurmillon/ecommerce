@extends('layouts.admin')

@section('admin_content')

<div class="hold-transition login-page">
	<div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Admin</b>Panel</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Admin Login Panel</p>

        <form action="{{ route('login') }}" method="post">
          @csrf
           @if(session('error'))
               <strong class="text-danger">{{ session('error') }}</strong>
            @endif
            @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }} name="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
            @if (Route::has('password.request'))
              <p class="mb-1">
                <a href="{{ route('password.request') }}">I forgot my password</a>
              </p>
            @endif
            <p class="mb-0">
              <a href="register.html" class="text-center">Register a new membership</a>
            </p>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</div>
@endsection