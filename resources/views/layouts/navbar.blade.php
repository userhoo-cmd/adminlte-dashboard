<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @auth
        <!-- User Dropdown Menu -->

        <li class="nav-item dropdown user-menu">
    <a href="{{ route('profile.edit') }}" class="nav-link dropdown-toggle d-flex align-items-center" aria-expanded="false">
        <!-- Top-right Avatar Preview -->
        <img id="navbar-avatar" src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
        <span class="d-none d-md-inline ml-2 font-weight-bold text-dark">
            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
        </span>
    </a>
</li>


                <!-- Menu Footer-->
                 <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
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

<!-- Scripts (keep these at the bottom) -->
<script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
<script>
    function previewTopRightImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('topright-avatar');
            preview.src = reader.result; // Set the image source to the selected file
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<script>
    // 🔹 Refresh sidebar and navbar avatars after successful update
    const newAvatar = "{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}";
    document.getElementById('sidebar-avatar').src = newAvatar;
    document.getElementById('navbar-avatar').src = newAvatar;
</script>

