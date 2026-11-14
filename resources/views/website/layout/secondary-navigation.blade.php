<nav class="navbar navbar-dark bg-custom-primary" aria-label="Dark offcanvas navbar">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">{{$user->first_name}}, {{$user->last_name}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarDark" aria-controls="offcanvasNavbarDark">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-custom-primary-blue" tabindex="-1" id="offcanvasNavbarDark" aria-labelledby="offcanvasNavbarDarkLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-white fw-bold" id="offcanvasNavbarDarkLabel">{{$user->first_name}}, {{$user->last_name}}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        @if( \App\Models\Page::where('slug', 'home')->where('user_id', $user->id)->where('status', 1)->count() > 0 )
                            <a class="nav-link active" aria-current="page" href="{{route('page.show', ['institute' => $institute->slug,'user' => $user->slug, 'page' => \App\Models\Page::where('slug', 'home')->where('user_id', $user->id)->where('status', 1)->pluck('slug')->first()])}}">Home</a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if( \App\Models\Page::whereIn('title', ['About', 'ABOUT', 'About Us', 'ABOUT US', 'about us', 'About us'])->where('user_id', $user->id)->where('status', 1)->count() > 0 )
                            <a class="nav-link active" aria-current="page" href="{{route('page.show', ['institute' => $institute->slug,'user' => $user->slug, 'page' => \App\Models\Page::whereIn('title', ['About', 'ABOUT', 'About Us', 'ABOUT US', 'about us', 'About us'])->where('user_id', $user->id)->where('status', 1)->pluck('slug')->first()])}}">About</a>
                        @endif
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            TLA
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('website.rationales', ['institute' => $institute->slug,'user' => $user->slug])}}">Rationales</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('website.action-plan', ['institute' => $institute->slug,'user' => $user->slug])}}">
                            Action Plan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Lesson Plans
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Observations
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('website.observations', ['institute' => $institute->slug,'user' => $user->slug, 'type' => 'Link Tutor'])}}">Link Tutor Observations</a></li>
                            <li><a class="dropdown-item" href="{{route('website.observations', ['institute' => $institute->slug,'user' => $user->slug, 'type' => 'Mentor'])}}">Mentor Observations</a></li>
                            <li><a class="dropdown-item" href="{{route('website.observations', ['institute' => $institute->slug,'user' => $user->slug, 'type' => 'Expert'])}}">Expert Observations</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('institute.shadow-form', ['institute' => $institute->slug, 'user' => $user->slug])}}">
                            Shadow forms
                        </a>
                    </li>
                    @if(\App\Models\Reflection::where('user_id', $user->id)->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('website.reflections', ['institute' => $institute->slug,'user' => $user->slug])}}">
                                Reflections
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('website.placement-tasks', ['institute' => $institute->slug,'user' => $user->slug])}}">
                            Placement Tasks
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Placement Documents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('website.minimum-core', ['institute' => $institute->slug,'user' => $user->slug])}}">
                            Minimum Core
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('website.achievements', ['institute' => $institute->slug,'user' => $user->slug])}}">
                            CPD
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Professional Standards
                        </a>
                    </li>
                    @if(\App\Models\Review::where('user_id', $user->id)->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('website.reviews', ['institute' => $institute->slug,'user' => $user->slug])}}">
                                Reviews
                            </a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Feedbacks
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('website.feedback.observations', ['institute' => $institute->slug,'user' => $user->slug])}}">Feedback</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('website.hour-logs', ['institute' => $institute->slug,'user' => $user->slug])}}">
                            Teaching Hour Logs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('portfolio.user', ['institute' => $institute->slug,'user' => $user->slug])}}">
                            Portfolio
                        </a>
                    </li>
                    @if( \App\Models\Page::whereIn('title', ['Accountability'])->where('user_id', $user->id)->where('status', 1)->count() > 0 )
                        <li class="nav-item">
                            <a aria-current="page" class="nav-link" href="{{route('page.show', ['institute' => $institute->slug,'user' => $user->slug, 'page' => \App\Models\Page::whereIn('title', ['Accountability'])->where('user_id', $user->id)->where('status', 1)->pluck('slug')->first()]) }}">Accountability</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Subject Specialist
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('institute.user.posts', ['institute' => $institute->slug,'user' => $user->slug]) }}">Blog</a></li>
                            @if( \App\Models\Page::whereIn('title', ['Vlog'])->where('user_id', $user->id)->where('status', 1)->count() > 0 )
                                <li><a class="dropdown-item" href="{{route('page.show', ['institute' => $institute->slug,'user' => $user->slug, 'page' => \App\Models\Page::whereIn('title', ['Vlog'])->where('user_id', $user->id)->where('status', 1)->pluck('slug')->first()]) }}">Vlog</a></li>
                            @endif
                            @if( \App\Models\Page::whereIn('title', ['Innovative Resource'])->where('user_id', $user->id)->where('status', 1)->count() > 0 )
                                <li><a class="dropdown-item" href="{{route('page.show', ['institute' => $institute->slug,'user' => $user->slug, 'page' => \App\Models\Page::whereIn('title', ['Innovative Resource'])->where('user_id', $user->id)->where('status', 1)->pluck('slug')->first()]) }}">Innovative Resource</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
