<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="@if(app()->getLocale() == 'ar'){{ mix('/css/rtl.css') }} @else {{mix('/css/ltr.css') }}@endif">
    <script>
        window.app = {!!json_encode([
            'csrfToken' => csrf_token(),
            'locales' => [
                'list' => config('app.locales'),
                'locale' => app()->getLocale(),
            ],
            'home' => __r('front:home'),
            'auth' => Auth::check(),
            'user' => Auth::check() ? Auth::user() : '',
            'fullUrl' => request()->fullUrl()
        ])!!}
    </script>
    <script src="{{mix('/js/app.js')}}" defer></script>
</head>

<body class="@if(app()->getLocale() == 'ar') rtl @endif">
    <div id="app">
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">{{config('app.name')}}</h5>
            <b-nav>
                <nav-locale></nav-locale>
                @auth
                <nav-user>
                    <b-dropdown-item href="{{__r('auth:profile')}}">{{__('text.profile')}}</b-dropdown-item>
                    @admin
                    <b-dropdown-item href="{{route('admin:home')}}">{{__('text.admin')}}</b-dropdown-item>
                    @endadmin
                </nav-user>
                <button class="btn btn-outline-primary" @click.prevent="signOut">{{__('text.logout')}}</button>
                @else
                    <b-button v-b-modal.modal-login variant="outline-primary">{{__('text.login')}}</b-button>
                @endif
            </b-nav>
        </div>
        <div class="container" >
            @yield('content')
        </div>
        <modal-auth></modal-auth>
    </div>
</body>
</html>
