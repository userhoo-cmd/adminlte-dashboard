@extends('adminlte::page')

@section('title', 'Login')

@section('content')
<div class="d-flex justify-content-center align-items-center position-relative" style="min-height: 100vh;">
    <div class="login-box custom-login-position">
        <div class="login-logo">
            <a href="#"><b>Admin</b>LTE</a>
        </div>

        <div class="card shadow">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>
                </form>

                <p class="mb-1 mt-3">
                    <a href="{{ route('password.request') }}">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Register a new account</a>
                </p>
            </div>
        </div>
    </div>
</div>

@guest
<style>
    /* Hide sidebar & brand for guest (login/register) */
    .main-sidebar, .brand-link { display: none !important; }
    body { margin-left: 0 !important; background-color: #f4f6f9; }

    /* Custom login position */
    .custom-login-position {
        position: relative;
        left: -80px;  /* shift left */
        top: -50px;   /* shift up */
    }

    /* Responsive reset */
    @media (max-width: 991px) {
        .custom-login-position {
            left: 0;
            top: 0;
        }
    }
</style>
@endguest
@stop
