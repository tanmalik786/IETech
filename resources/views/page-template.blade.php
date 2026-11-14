@extends('website.layout.app')

@push('page-styles')
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <style>
        .portrait-img {
            width: 100%;
            scale: 1;
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

        .list-experience-item {
            display: flex;
            flex-direction: row;
        }

        .section-has-bg {
            min-height: 100vh;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .section-has-bg h3 {
            z-index: 1;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.3);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .card-image-wrapper {
            width: 100%;
            height: 250px;
            overflow: hidden;
        }

        .carousel-caption {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100%;
        }

    </style>
@endpush
@section('content')
    @if(empty($page))
        <div class="col-lg-12">
            <h3 class="text-center">No Content Found</h3>
        </div>
    @else
        @include('website.layout.secondary-navigation')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      const initWowjs = () => {
        new WOW().init();
      };

      initWowjs();
    </script>
    <script>
    </script>
@endpush

