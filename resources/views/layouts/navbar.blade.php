<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">{{ __('Dashboard') }}</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- 🌐 Language Switcher -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                <i class="fas fa-language"></i> {{ strtoupper(app()->getLocale()) }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @php
                    $languages = [
                        'en' => ['name' => 'English', 'flag' => '🇬🇧'],
                        'es' => ['name' => 'Español', 'flag' => '🇪🇸'],
                        'fr' => ['name' => 'Français', 'flag' => '🇫🇷'],
                        'de' => ['name' => 'Deutsch', 'flag' => '🇩🇪'],
                        'ms' => ['name' => 'Bahasa Melayu', 'flag' => '🇲🇾'],
                        'zh' => ['name' => '中文', 'flag' => '🇨🇳'],
                        'ja' => ['name' => '日本語', 'flag' => '🇯🇵'],
                        'ko' => ['name' => '한국어', 'flag' => '🇰🇷'],
                    ];
                @endphp
                @foreach ($languages as $code => $lang)
                    <a href="{{ route('lang.switch', $code) }}"
                       class="dropdown-item d-flex align-items-center {{ app()->getLocale() === $code ? 'active bg-light' : '' }}">
                        <span style="font-size: 1.2em; margin-right: 8px;">{{ $lang['flag'] }}</span>
                        {{ $lang['name'] }}
                    </a>
                @endforeach
            </div>
        </li>

        <!-- 🧍 User Menu -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ Auth::user()->avatar
                    ? asset('storage/' . Auth::user()->avatar)
                    : asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}"
                    class="user-image img-circle elevation-2"
                    id="navbar-avatar"
                    alt="User Image">
                <span class="d-none d-md-inline">{{ Auth::user()->first_name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{ Auth::user()->avatar
                        ? asset('storage/' . Auth::user()->avatar)
                        : asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}"
                        class="img-circle elevation-2"
                        alt="User Image">
                    <p>
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        <small>{{ Auth::user()->email }}</small>
                    </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">{{ __('Profile') }}</a>
                    <a href="#" class="btn btn-default btn-flat float-right"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Sign out') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
