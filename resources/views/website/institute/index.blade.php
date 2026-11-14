@extends('website.layout.app')

@push('page-styles')
    <style>
        .section-institute-home {
            background-image: url("{{asset('images/inst-bg.jpg')}}");
            background-position: center center;
            background-size: cover;
            position: relative;
        }

        .section-institute-home .col-lg-6 {
            min-height: 20rem;
            color: #fff;
            letter-spacing: 0.6rem;
        }

        .section-institute-home h3 {
            font-size: 2.5rem;
            z-index: 1;
        }

        .section-institute-home .overlay {
            background-color: rgba(0,0,0,0.7);
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .heading {
            font-size: 1.5rem;
            letter-spacing: 0.33rem;
        }

        .heading-bordered {
            padding-bottom: 0.5rem;
            border-bottom: 3px solid #000;
        }

        a.card {
            transition: 50ms ease-in;
            border-color: transparent;
            box-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }

        a.card:hover {
            box-shadow: 3px 3px 10px rgba(0,0,0,0.1);
        }

        .card-image {
            width: 100%;
            max-height: 200px;
            overflow: hidden;
        }

        .card-image  img{
            width: 100%;
        }
    </style>
@endpush
@section('content')
    <section class="section section-institute-home">
        <div class="container">
            <div class="col-lg-6 offset-lg-3 d-flex justify-content-center align-items-center">
                <h3 class="text-center">{{$institute->name}}</h3>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    @if( auth()->user()->institute_id === $institute->id)
        <section class="py-5 my-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <h3 class="m-auto text-dark heading heading-bordered d-inline-block">Portfolios</h3>
                    </div>
                </div>
                <div class="row my-5 py-5">
                    @forelse($users as $user)
                        <div class="col-lg-3">
                            <a href="{{route('portfolio.user', ['institute'=> $institute->slug, 'user' => $user->slug])}}" class="card">
                                <div class="card-image">
                                    @if($user->profileImage)
                                        <img class="portrait-img" src="{{asset('storage/media/' . $user->profileImage->file_name)}}" alt="{{$user->slug}}">
                                    @else
                                        <img  src="https://images.pexels.com/photos/3748221/pexels-photo-3748221.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="" class="portrait-img">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{$user->first_name}}, {{$user->last_name}}</h5>
                                    <p class="card-text">{{$user->roles[0]->name}}</p>
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>
    @endif
    @if(! empty($page->sections))
        @foreach($page->sections as $section)
            @switch( $section->section_type_id )
                @case('1')
                <section class="section section-content my-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                {!! $section->sectionable->content !!}
                            </div>
                        </div>
                    </div>
                </section>
                @break
                @case('2')
                <section class="section section-has-bg"
                         style="background-image: url({{asset('storage/pages/featured-images/'. $section->sectionable->name)}})"
                >
                    <div class="d-flex justify-content-center align-items-center">
                        <h3 class="text-center text-white">{{$page->title}}</h3>
                        <div class="overlay"></div>
                    </div>
                </section>
                @break
                @case('3')
                @if($section->sectionable()->where('type', 'slider')->where('status', 1)->count() > 0)
                    @php
                        $slider = $section->sectionable()->where('type', 'slider')->where('status', 1)->whereHas('slides')->first();
                    @endphp
                    @if( $slider )
                        <section class="section section-slider mb-5">
                            <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-interval="1000">
                                <div class="carousel-indicators">
                                    @if( ! empty($slider->slides))
                                        @foreach($slider->slides as $key => $slide)
                                            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}" {{$key == 0 ? 'aria-current="true"' : '' }}  aria-label="{{$slide->title}}"></button>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="carousel-inner">
                                    @if( ! empty($slider->slides))
                                        @foreach($slider->slides as $key => $slide)
                                            <div class="carousel-item {{$key == 0 ? 'active': ''}}">
                                                <svg class="" style="background-image: url('{{asset("storage/slides/" . $slide->name)}}');background-size: cover;background-position:center center;" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                                                    <rect width="100%" height="100%" fill="rgb(89,29,114)" opacity="0.4"/>
                                                </svg>
                                                <div class="container">
                                                    <div class="carousel-caption text-center">
                                                        <h1>{{$slide->title}}</h1>
                                                        <p>{{$slide->subtitle}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
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
                        </section>
                    @endif
                @endif
                @break
                @case('4')
                @if($section->sectionable()->where('type', 'carousel')->where('status', 1)->count() > 0)
                    @php
                        $slider = $section->sectionable()->where('type', 'carousel')->whereHas('slides')->where('status', 1)->first();
                    @endphp
                    @if( $slider )
                        <section class="section section-slider mb-5">
                            <div class="container">
                                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        @if( ! empty($slider->slides))
                                            @foreach($slider->slides->chunk(3) as $key => $chunk)
                                                @foreach($chunk as $slide)
                                                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}" {{$key == 0 ? 'aria-current="true"' : '' }}  aria-label="{{$slide->title}}"></button>
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="carousel-inner">
                                        @if( ! empty($slider->slides))
                                            @foreach($slider->slides->chunk(3) as $key => $chunk)
                                                <div class="carousel-item {{$key == 0 ? 'active': ''}}">
                                                    <div class="row">
                                                        @foreach($chunk as $slide)
                                                            <div class="col-lg-4">
                                                                <div class="card">
                                                                    <div class="card-image-wrapper">
                                                                        <img class="card-img-top" src="{{asset("storage/slides/" . $slide->name)}}" alt="">
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <h1 class="text-dark">{{$slide->title}}</h1>
                                                                        <p class="text-dark">{{$slide->subtitle}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
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
                            </div>
                        </section>
                    @endif
                @endif
                @break
                @case('5')
                <div class="container my-5">
                    <object style="min-width:100%;min-height:800px;" data="{{asset('storage/pages/pdf/'. $section->sectionable->name)}}" type="application/pdf">
                        <iframe style="min-width:100%;min-height:800px;" src="https://docs.google.com/viewer?url={{asset('storage/pages/pdf/'. $section->sectionable->name)}}&embedded=true"></iframe>
                    </object>
                </div>
                @break
            @endswitch
        @endforeach
    @endif
@endsection

@push('page-scripts')
@endpush

