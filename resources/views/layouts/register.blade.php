@extends('adminlte::page')

<form action="{{ route('register') }}" method="POST">
    @csrf

    <div class="input-group mb-3">
        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
        </div>
    </div>

    <div class="input-group mb-3">
        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
        </div>
    </div>

    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
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

    <div class="input-group mb-3">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Register</button>
</form>
