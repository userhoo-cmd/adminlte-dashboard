@extends('adminlte::page')

@section('title', __('Dashboard'))

@section('content_header')
    <h1>{{ __('Dashboard') }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <!-- Profile Overview -->
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline text-center">
                <div class="card-body box-profile">
                    <div class="text-center mb-3">
                        <img id="profile-avatar"
                             class="profile-user-img img-fluid img-circle"
                             src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}"
                             alt="{{ Auth::user()->first_name }}">
                    </div>
                    <h3 class="profile-username text-center">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </h3>
                    <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block">
                        <b>{{ __('Edit Profile') }}</b>
                    </a>
                </div>
            </div>
        </div>

        <!-- Update Profile Form -->
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Update Profile') }}</h3>
                </div>
                <form id="update-profile-form"
                      action="{{ route('profile.update') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="first_name">{{ __('First Name') }}</label>
                            <input type="text" name="first_name" id="first_name"
                                   value="{{ old('first_name', Auth::user()->first_name) }}"
                                   class="form-control @error('first_name') is-invalid @enderror">
                            @error('first_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name">{{ __('Last Name') }}</label>
                            <input type="text" name="last_name" id="last_name"
                                   value="{{ old('last_name', Auth::user()->last_name) }}"
                                   class="form-control @error('last_name') is-invalid @enderror">
                            @error('last_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="bio">{{ __('Bio') }}</label>
                            <textarea name="bio" id="bio"
                                      class="form-control @error('bio') is-invalid @enderror"
                                      rows="3">{{ old('bio', Auth::user()->bio) }}</textarea>
                            @error('bio')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="avatar">{{ __('Avatar') }}</label>
                            <input type="file" name="avatar" id="avatar"
                                   class="form-control-file @error('avatar') is-invalid @enderror"
                                   accept="image/*"
                                   onchange="previewAvatar(event)">
                            @error('avatar')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            <div class="mt-3 text-center">
                                <img id="avatar-preview"
                                     src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}"
                                     class="img-thumbnail rounded-circle"
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">{{ __('Update Profile') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
function previewAvatar(event) {
    const input = event.target;
    const preview = document.getElementById('avatar-preview');
    const file = input.files ? input.files[0] : null;

    if (file) {
        const reader = new FileReader();
        reader.onload = e => preview.src = e.target.result;
        reader.readAsDataURL(file);
    }
}
</script>
@stop
