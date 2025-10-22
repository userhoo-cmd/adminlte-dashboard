@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success" style="background-color: lightblue;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- First Name -->
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
        </div>

        <!-- Last Name -->
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">New Password (optional)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <!-- Avatar (Optional) -->
        <div class="form-group">
            <label for="avatar">Avatar (Optional)</label>
            <input type="file" name="avatar" id="avatar" class="form-control" onchange="previewAvatar(event)">
            <br>

            <!-- Avatar Preview -->
           <img id="preview" src="{{ asset('storage/' . Auth::user()->avatar) }}" width="100">
<img id="sidebar-avatar" src="{{ asset('storage/' . Auth::user()->avatar) }}" width="50">
<img id="navbar-avatar" src="{{ asset('storage/' . Auth::user()->avatar) }}" width="40">


        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
    <script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById('preview');
        const sidebarAvatar = document.getElementById('sidebar-avatar');
        const navbarAvatar = document.getElementById('navbar-avatar');
        const newImage = reader.result;

        if (preview) preview.src = newImage;
        if (sidebarAvatar) sidebarAvatar.src = newImage;
        if (navbarAvatar) navbarAvatar.src = newImage;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</div>

<script>
    // Live preview for avatar
    function previewAvatar(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('avatar-preview');
            preview.src = reader.result;  // Set the image source to the selected file
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
@if (session('success'))
    <div class="alert alert-info alert-dismissible fade show mt-3" role="alert" style="background-color:#cce5ff;">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

