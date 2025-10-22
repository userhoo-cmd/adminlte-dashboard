<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light"><b>My</b>Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img id="sidebar-avatar"
                     src="{{ Auth::user()->avatar
                        ? asset('storage/' . Auth::user()->avatar)
                        : asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}"
                     class="img-circle elevation-2"
                     style="width:40px; height:40px; object-fit:cover;"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profile.edit') }}" class="d-block">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

                <!-- Profile -->
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>

                <!-- Change Password -->
                <li class="nav-item">
                    <a href="{{ route('password.request') }}" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>Change Password</p>
                    </a>
                </li>

                <!-- 🔒 Only Super Admin can see these -->
                @role('superadmin')
                    <li class="nav-header">MANAGEMENT</li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Products</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Orders</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>Sales</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>Payments</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>Manage Users</p>
                        </a>
                    </li>
                @endrole

                <!-- Logout -->
                <li class="nav-item mt-3">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>

{{-- ✅ Auto-refresh avatars after update --}}
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
