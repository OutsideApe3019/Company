<div class="sticky-top">
    @include('layouts.navs.nav')

    @auth
        @if (Auth::user()->isAdmin)
            @include('layouts.navs.panel')
        @endif
    @endauth
</div>