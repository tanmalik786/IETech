@extends('website.layout.app')

@push('page-styles')
    <style>
        list-experience-item {
            display: flex;
            flex-direction: row;
        }
        .list-item-action-buttons {
            flex-grow: 2;
            display: flex;
            align-items: start;
            justify-content: end;
            flex-direction: row;
            padding-right: 1rem;
        }
        .section-with-bg {
            background-image: url("{{asset('images/inst-bg.jpg')}}");
            background-position: center center;
            background-size: cover;
            position: relative;
        }

        .section-with-bg .col-lg-6 {
            min-height: 20rem;
            color: #fff;
            letter-spacing: 0.6rem;
        }

        .section-with-bg h3 {
            font-size: 2.5rem;
            z-index: 1;
        }

        .section-with-bg .overlay {
            background-color: rgba(0, 0, 0, 0.7);
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .portrait-img {
            width: 100%;
            scale: 1.5;
            object-position: cover;
        }

        .img-wrapper {
            margin: 0 auto;
            width: 80px;
            height: 80px;
            border-radius: 100%;
            overflow: hidden;
            box-shadow: 10px 10px 10px rgb(89 29 114 / 14%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #profileImage {
            opacity: 0;
            pointer-events: none;
        }

        .js-image-change-btn {
            cursor: pointer;
            position: absolute;
            right: 25%;
            top: 22%;
        }

    </style>
@endpush
@section('content')
    @include('website.layout.secondary-navigation')
    <section class="section section-with-bg">
        <div class="container">
            <div class="col-lg-6 offset-lg-3 d-flex justify-content-center align-items-center flex-column">
                <h3 class="text-center">CPD</h3>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    @if( empty($achievements) )
        <section class="my-5 py-5">
            <div class="container">
                <div class="col-lg-6 offset-lg-3">
                    <h3 class="text-center">No data found</h3>
                </div>
            </div>
        </section>
    @else
        <section class="section py-5">
            <div class="container">
                <div class="col-lg-8 offset-lg-2">
                    <ul class="list-experience list-unstyled">
                    @foreach( $achievements as $key => $achievement)
                        <li class="list-experience-item list-experience-item-editable mt-3 mb-4 border pt-3 pb-3" data-id="" style="padding-left: 50px">
                            <i class="bi bi-mortarboard-fill mr-2" style="font-size: 2rem"></i>
                            <div class="d-flex flex-column">
                                <p class="fw-bold text-dark mb-0">{{$achievement->title}} | {{$achievement->category}}</p>
                                <p class="text-muted mb-0">
                                    {{\Carbon\Carbon::parse($achievement->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first())->format('d F Y')}} |
                                    {{$achievement->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first() != null ? "Duration {$achievement->postMetas->where('meta_key', 'duration_hours')->pluck('meta_value')->first()} Hours, " : ""}}
                                    {{$achievement->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first() != null ? "{$achievement->postMetas->where('meta_key', 'duration_minutes')->pluck('meta_value')->first()} minutes" : ""}}
                                </p>
                                @if(!empty($achievement->content))
                                    {!! $achievement->content !!}
                                @endif
                            </div>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </section>
    @endif


@endsection

@push('page-scripts')

@endpush

