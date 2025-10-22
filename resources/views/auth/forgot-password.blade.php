@extends('adminlte::page')

@section('title', 'Forgot Password')

@section('content')
<div class="d-flex justify-content-center align-items-center position-relative" style="min-height: 100vh;">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Admin</b>LTE</a>
        </div>

        <div class="card shadow">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Reset Password</p>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.request') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
                        </div>
                    </div>
                </form>
                <p class="mt-3">
                    <a href="{{ route('login') }}">Back to Login</a>
                </p>
            </div>
        </div>
    </div>
</div>
@stop
