<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @auth
        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                <img src="{{ Auth::user()->avatar 
                    ? asset('storage/avatars/' . Auth::user()->avatar) 
                    : asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}" 
                    class="user-image img-circle elevation-2 mr-2"
                    style="width:35px;height:35px;object-fit:cover;border-radius:50%;"
                    alt="User Image">
                <span class="d-none d-md-inline font-weight-medium">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </span>
            </a>

            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow">
                <!-- User Header -->
                <li class="user-header bg-primary">
                    <img src="{{ Auth::user()->avatar 
                        ? asset('storage/avatars/' . Auth::user()->avatar) 
                        : asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}" 
                        class="img-circle elevation-2" 
                        alt="User Image"
                        style="width:80px;height:80px;object-fit:cover;">
                    <p class="mt-2 mb-0">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </p>
                    <small>{{ Auth::user()->email }}</small>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a>
                    <a href="#" class="btn btn-default btn-flat float-right"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Sign out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
        @endauth

        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
        @endguest
    </ul>
</nav>

<!-- JS (ensure these are loaded at the bottom of your layout) -->
<script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
