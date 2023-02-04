<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/panel') }}">
            Admin panel
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('panel') }}">{{ __('Panel') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('panel.users') }}">{{ __('Users') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('panel.tickets') }}">{{ __('Tickets') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('panel.alerts') }}">{{ __('Alerts') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
