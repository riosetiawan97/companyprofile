@extends('layout.masterauth')
@section('title')
<title>Login</title>
@endsection

@section('content')
<div class="card card-login mx-auto mt-5">
    <div class="card-header">Login</div>
    <div class="card-body">
        <form method="POST" action="{{ route('login.submit') }}" class="user">
        {{ csrf_field() }}
        @if (session('error'))
                    @alert(['type' => 'danger'])
                        {{ session('error') }}
                    @endalert
                @endif
            <div class="form-group">
                <div class="form-label-group">
                    <input name="username" id="inputEmail" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
                    <label for="inputEmail">Username</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                    <label for="inputPassword">Password</label>
                </div>
            </div>
            <!-- <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me">
                        Remember Password
                    </label>
                </div>
            </div> -->
            <button type="submit" name="submit" class="btn btn-primary btn-block">
                Login
            </button>
        </form>
        <!-- <div class="text-center">
          <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div> -->
    </div>
</div>
@endsection