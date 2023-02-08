<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">Company</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact us') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('support') }}">{{ __('Support') }}</a>
                </li>
            </ul>
            <hr>
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    @php
                        $totalAlerts = Alert::where('userId', Auth::user()->id)
                            ->where('read', false)
                            ->count();
                    @endphp
                    <li class="nav-item">
                        <a href="{{ route('user.alerts') }}" class="nav-link">
                            <i class="fa-solid fa-bell"></i>
                            @if ($totalAlerts > 0)
                                <span
                                    class="position-absolute top-1 start-1 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <span class="">
                                <i class="fa-solid fa-message"></i>
                            </span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">{{ Auth::user()->username }}</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('settings') }}">
                                    {{ __('Settings') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('user', ['username' => Auth::user()->username]) }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
