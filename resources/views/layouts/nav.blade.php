@php
    use App\Models\Alert;
@endphp
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Company') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto"></ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact us') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('support') }}">{{ __('Support') }}</a>
                </li>
                @auth
                    @if (Auth::user()->isAdmin)
                        <div class="vr mobile"></div>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('panel') }}">{{ __('Panel') }}</a>
                        </li>
                    @endif
                @endauth
                <div class="vr mobile"></div>
                <hr>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    @php
                        $totalAlerts = Alert::where('userId', Auth::user()->id)->where('read', false)->count();
                    @endphp
                    <li class="nav-item">
                        <a href="{{ route('user.alerts') }}" class="nav-link">
                            <i class="fa-solid fa-bell"></i>
                            @if ($totalAlerts > 0)
                                <span class="position-absolute top-1 start-1 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"><span class=""><i
                                    class="fa-solid fa-message"></i></span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('settings') }}">
                                {{ __('Settings') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
