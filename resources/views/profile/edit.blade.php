@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>

    {{-- ✅ Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- 🌐 Language Selector --}}
    <form action="{{ route('language.switch') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group" style="max-width: 250px;">
            <label for="language"><strong>Language:</strong></label>
            <select name="locale" id="language" class="form-control" onchange="this.form.submit()">
                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                <option value="ms" {{ app()->getLocale() == 'ms' ? 'selected' : '' }}>Bahasa Melayu</option>
                <option value="zh" {{ app()->getLocale() == 'zh' ? 'selected' : '' }}>中文</option>
            </select>
        </div>
    </form>

    {{-- ✅ Profile Form --}}
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- First Name -->
        <div class="form-group mt-3">
            <label for="first_name">First Name</label>
            <input type="text" 
                   name="first_name" 
                   id="first_name" 
                   class="form-control" 
                   value="{{ old('first_name', $user->first_name) }}" 
                   required>
        </div>

        <!-- Last Name -->
        <div class="form-group mt-3">
            <label for="last_name">Last Name</label>
            <input type="text" 
                   name="last_name" 
                   id="last_name" 
                   class="form-control" 
                   value="{{ old('last_name', $user->last_name) }}" 
                   required>
        </div>

        <!-- Email -->
        <div class="form-group mt-3">
            <label for="email">Email</label>
            <input type="email" 
                   name="email" 
                   id="email" 
                   class="form-control" 
                   value="{{ old('email', $user->email) }}" 
                   required>
        </div>

        <!-- Password -->
        <div class="form-group mt-3">
            <label for="password">New Password (optional)</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
        </div>

        <div class="form-group mt-3">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <!-- Avatar Upload -->
        <div class="form-group mt-3">
            <label for="avatar">Avatar (optional)</label>
            <input type="file" 
                   name="avatar" 
                   id="avatar" 
                   class="form-control" 
                   accept="image/*" 
                   onchange="previewAvatar(event)">
        </div>

        <!-- Avatar Previews -->
        <div class="mt-3 d-flex align-items-center gap-3">
            <div>
                <p><strong>Current Avatar:</strong></p>
                <img id="preview" 
                     src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('default-avatar.png') }}" 
                     width="100" 
                     class="rounded-circle border">
            </div>

            <div>
                <p><strong>Sidebar:</strong></p>
                <img id="sidebar-avatar" 
                     src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('default-avatar.png') }}" 
                     width="50" 
                     class="rounded-circle border">
            </div>

            <div>
                <p><strong>Navbar:</strong></p>
                <img id="navbar-avatar" 
                     src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('default-avatar.png') }}" 
                     width="40" 
                     class="rounded-circle border">
            </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary mt-4">Update Profile</button>
    </form>
</div>

{{-- ✅ Live Preview Script --}}
<script>
function previewAvatar(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const imageSrc = reader.result;
        const preview = document.getElementById('preview');
        const sidebarAvatar = document.getElementById('sidebar-avatar');
        const navbarAvatar = document.getElementById('navbar-avatar');

        if (preview) preview.src = imageSrc;
        if (sidebarAvatar) sidebarAvatar.src = imageSrc;
        if (navbarAvatar) navbarAvatar.src = imageSrc;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
