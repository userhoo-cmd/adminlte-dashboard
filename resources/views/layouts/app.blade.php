<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    {{-- ✅ Top Navbar --}}
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            {{-- 🌐 Language Switcher --}}
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-language"></i> {{ strtoupper(app()->getLocale()) }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('locale.switch', 'en') }}" class="dropdown-item">English</a>
                    <a href="{{ route('locale.switch', 'ms') }}" class="dropdown-item">Malay</a>
                    <a href="{{ route('locale.switch', 'zh') }}" class="dropdown-item">中文</a>
                </div>
            </li>

            {{-- 👤 User Menu --}}
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <img id="navbar-avatar"
                         src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar)
                         : asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}"
                         class="img-circle elevation-2"
                         alt="User Image"
                         style="width:30px; height:30px; object-fit:cover;">
                    <span class="ml-1">{{ Auth::user()->first_name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </li>
        </ul>
    </nav>

    {{-- ✅ Sidebar --}}
    @include('layouts.sidebar')

    {{-- ✅ Main Content --}}
    <div class="content-wrapper">
        @yield('content')
    </div>

</div>

<!-- AdminLTE JS -->
<script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

{{-- ✅ Avatar auto-refresh --}}
@if (session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    const newAvatar = "{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}";
    const sidebarAvatar = document.getElementById('sidebar-avatar');
    const navbarAvatar = document.getElementById('navbar-avatar');
    if (sidebarAvatar) sidebarAvatar.src = newAvatar;
    if (navbarAvatar) navbarAvatar.src = newAvatar;
});
</script>
@endif
</body>
</html>
