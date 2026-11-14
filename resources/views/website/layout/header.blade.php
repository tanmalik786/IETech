<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center py-2 justify-content-md-between">
        <a href="{{route('institute', ['institute' => $institute->slug])}}" class="d-flex align-items-center col-md-4 mb-2 mb-md-0 text-dark text-decoration-none">
            <img src="{{asset('images/logo.png')}}" class="site-logo" alt="">
            <p class="fw-bold mx-2 m-0">{{$institute->name}}</p>
        </a>
{{--        @if(auth()->user() && isset($user) && \App\Models\Review::where('user_id', $user->id)->count() > 0)--}}
{{--            <a class="nav-link" href="{{route('website.reviews', ['institute' => $institute->slug, 'user' => $user->slug])}}">--}}
{{--                Reviews--}}
{{--            </a>--}}
{{--        @endif--}}
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{route('institute', ['institute' => $institute->slug])}}" class="nav-link px-2 link-dark {{Request::is(route('institute', ['institute' => $institute->slug])) ? 'active' : ''}}">Home</a></li>
            <li><a href="{{url("{$institute->slug}/about")}}" class="nav-link px-2 link-dark {{Request::is("{$institute->slug}/about") ? 'active' : ''}}">About</a></li>
            <li><a href="{{url("{$institute->slug}/services")}}" class="nav-link px-2 link-dark {{Request::is("{$institute->slug}/services") ? 'active' : ''}}">Services</a></li>
            <li><a href="{{route('institute.posts', ['institute'=> $institute->slug])}}" class="nav-link px-2 link-dark">Blog</a></li>
            @if(Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->full_name}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if( auth()->user()->hasAnyRole(['Teaching Student', 'Super Admin', 'Link Tutor', 'Institute Admin', 'Mentor']) )
                            <li><a class="dropdown-item" href="{{url('dashboard')}}" class="nav-link link-primary px-2 fw-bold">Dashboard</a></li>
                        @endif
                            @if( auth()->user()->hasAnyRole(['Link Tutor', 'Mentor']) )
                                <li><a class="dropdown-item" href="{{route('xpos', ['institute' => $institute->slug, 'user' => $user->slug])}}" class="nav-link link-primary px-2 fw-bold">Expert Observations</a></li>
                            @endif
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                    </ul>
                </li>
            @else
                <li><a href="{{route('login')}}" class="nav-link link-primary px-2 fw-bold">Login</a></li>
                <li><a href="{{route('register')}}" class="nav-link link-primary px-2 fw-bold">Register</a></li>
            @endif
        </ul>
    </header>
</div>