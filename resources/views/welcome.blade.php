@extends('website.layout.app')

@push('page-styles')
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <style>
        .portrait-img {
            width: 100%;
            scale: 1.5;
            object-position: cover;
        }

        .img-with-bg {
            margin: 0 auto;
            width: 300px;
            height: 300px;
            border-radius: 100%;
            overflow: hidden;
            box-shadow: 10px 10px 10px rgb(89 29 114 / 14%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .list-experience-item{
            display: flex;
            flex-direction: row;
        }
    </style>
@endpush
@section('content')
    <nav class="navbar navbar-dark bg-custom-primary" aria-label="Dark offcanvas navbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Usman Shaukat</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarDark" aria-controls="offcanvasNavbarDark">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-custom-primary-blue" tabindex="-1" id="offcanvasNavbarDark" aria-labelledby="offcanvasNavbarDarkLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-white fw-bold" id="offcanvasNavbarDarkLabel">Usman Shaukat</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">TLA</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Observations
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Reflections
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action Plan
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Expert Observations
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Evidence
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Mentor Meetings
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            @php
            $images = [
    'https://images.pexels.com/photos/2173508/pexels-photo-2173508.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
    'https://images.pexels.com/photos/3184317/pexels-photo-3184317.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
    'https://images.pexels.com/photos/1708912/pexels-photo-1708912.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'
];
            @endphp
            @for($i=0; $i < 3; $i++)
            <div class="carousel-item {{$i == 0 ? 'active': ''}}">
                <svg class="" style="background-image: url('{{$images[$i]}}');background-size: cover;background-position:center center;" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="rgb(89,29,114)" opacity="0.4"/>
                </svg>
                <div class="container">
                    <div class="carousel-caption text-center">
                        <h1>Example headline.</h1>
                        <p>Some representative placeholder content for the first slide of the carousel.</p>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <section class="mb-5 mt-5">
        <div class="container">
            <div class="row featurette">
                <div class="col-md-5">
                    <div class="d-flex w-100 h-100 justify-content-start flex-column">
                        <div class="img-with-bg wow rollIn center" data-wow-duration="2s" data-wow-delay="5s">
                            <img class="portrait-img" src="{{asset('images/headshot.jpeg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="d-flex justify-content-start h-100 w-100 flex-column">
                        <h2 class="featurette-heading subtitle fw-normal lh-1 mt-0 fw-bold">{{$user->first_name ?? ''}}, {{$user->last_name ?? ''}}</h2>
{{--                        <h3 class="subtitle">{{$user->tagline}}</h3>--}}
                        <div class="accordion accordion-flush w-100 mt-3" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="true" aria-controls="flush-collapseThree">
                                        Qualifications
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse show" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        @if(count($qualifications) >= 0)
                                            @foreach($qualifications as $qualification)
                                                <li class="list-experience-item mb-4">
                                                    <i class="bi bi-briefcase-fill me-2"></i>
                                                    <div class="d-flex flex-column">
                                                        <p class="fw-bold text-dark mb-0"> {{$qualification->postMetas->where('meta_key', 'degree')->pluck('meta_value')->first()}} - {{$qualification->title}}</p>
                                                        <p class="text-muted mb-0">
                                                            {{\Carbon\Carbon::parse($qualification->postMetas->where('meta_key', 'start_date')->pluck('meta_value')->first())->format('F Y')}} -
                                                            @if($qualification->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first() == null || $qualification->postMetas->where('meta_key', 'current_studying')->pluck('meta_value')->first() == 'yes')
                                                                Present
                                                            @else
                                                                {{\Carbon\Carbon::parse($qualification->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first())->format('F Y')}}
                                                            @endif
                                                        </p>
                                                        @if(!empty($qualification->content))
                                                            {!! $qualification->content !!}
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Experiences
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <ul class="list-experience list-unstyled">
                                            @if(count($professional_experiences) >= 0)
                                                <li class="text-capitalize text-primary mb-3">Professional</li>
                                                @foreach($professional_experiences as $experience)
                                                    <li class="list-experience-item mb-4">
                                                        <i class="bi bi-briefcase-fill me-2"></i>
                                                        <div class="d-flex flex-column">
                                                            <p class="fw-bold text-dark mb-0"> {{$experience->postMetas->where('meta_key', 'job_title')->pluck('meta_value')->first()}} - {{$experience->title}}</p>
                                                            <p class="text-muted mb-0">
                                                                {{\Carbon\Carbon::parse($experience->postMetas->where('meta_key', 'start_date')->pluck('meta_value')->first())->format('F Y')}} -
                                                                @if($experience->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first() == null || $experience->postMetas->where('meta_key', 'current')->pluck('meta_value')->first() == 'yes')
                                                                    Present
                                                                @else
                                                                    {{\Carbon\Carbon::parse($experience->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first())->format('F Y')}}
                                                                @endif
                                                            </p>
                                                            @if(!empty($experience->content))
                                                                {!! $experience->content !!}
                                                            @endif
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                            @if(count($research_experiences) >= 0)
                                                <li class="text-capitalize text-primary mb-3">Research</li>
                                                @foreach($research_experiences as $experience)
                                                    <li class="list-experience-item mb-4">
                                                        <i class="bi bi-briefcase-fill me-2"></i>
                                                        <div class="d-flex flex-column">
                                                            <p class="fw-bold text-dark mb-0"> {{$experience->postMetas->where('meta_key', 'job_title')->pluck('meta_value')->first()}} - {{$experience->title}}</p>
                                                            <p class="text-muted mb-0">
                                                                {{\Carbon\Carbon::parse($experience->postMetas->where('meta_key', 'start_date')->pluck('meta_value')->first())->format('F Y')}} -
                                                                @if($experience->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first() == null)
                                                                    Present
                                                                @else
                                                                    {{\Carbon\Carbon::parse($experience->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first())->format('F Y')}}
                                                                @endif
                                                            </p>
                                                            @if(!empty($experience->content))
                                                                {!! $experience->content !!}
                                                            @endif
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Achievements
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="bg-custom-gradient py-5">
        <div class="container py-5">
            <h2 class="text-center fw-bold text-white">Teaching Journey</h2>
            <p class="lead text-center text-white">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet ducimus earum eius est fugiat illum in incidunt iure, nesciunt omnis quaerat quasi quibusdam reiciendis rem, sit vitae voluptatum. Obcaecati, quidem?
            </p>
            <div class="album">
                <div class="container py-5">

                    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-3">
                        @php
                        $images = [
                            'https://images.pexels.com/photos/3184292/pexels-photo-3184292.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                            'https://images.pexels.com/photos/1181345/pexels-photo-1181345.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                            'https://images.pexels.com/photos/3183186/pexels-photo-3183186.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                            'https://images.pexels.com/photos/3758105/pexels-photo-3758105.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'
                        ];
                        @endphp
                        @for($i = 0; $i < 4; $i++)
                            <div class="col">
                                <div class="card shadow-sm">
                                    <svg class="card-img-top" style="background-image:url('{{$images[$i]}}');background-position:center center; background-size: cover" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                                        <rect fill="#333" width="100%" height="100%" opacity="0.1"></rect>
                                    </svg>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      const initWowjs = () => {
        new WOW().init();
      }

      initWowjs();
    </script>
@endpush

