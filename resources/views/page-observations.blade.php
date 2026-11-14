@extends('website.layout.app')

@push('page-styles')
    <style>
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
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        a.card:hover {
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
        }

        .card-quote {
            box-shadow: 3px 3px 10px rgba(234, 243, 243, 0.9);
        }

        .row-inverted:first-of-type {
            margin-top: 3rem;
        }

        .row-inverted:not(:last-of-type) {
            margin-bottom: 3rem;
        }

        .row-inverted:nth-child(even) {
            justify-content: flex-end;
        }

        .card .card-answer {
            padding-left: 1.5rem;
        }


        .card-question {
            font-weight: bold;
            letter-spacing: 0.1rem;
            color: #2d2d2d;
        }

        .card-answer {
            font-size: 1.5rem;
        }

        .calendar {
            margin-top: 0.5rem;
        }

        .calendar p,
        .calendar i {
            font-size: 0.7rem;
            color: #b4b4b4 !important;
        }

        .list-icon-wrapper {
            min-width: 10rem;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3rem;
        }
    </style>
@endpush
@section('content')
    @include('website.layout.secondary-navigation')
    @if( count($data['observations']) <= 0 )
        <section class="section section-with-bg">
            <div class="container">
                <div class="col-lg-6 offset-lg-3 d-flex justify-content-center align-items-center flex-column">
                    <h3 class="text-center">{{$data['title']}}</h3>
                </div>
            </div>
            <div class="overlay"></div>
        </section>
        <section class="my-5 py-5">
            <div class="container">
                <div class="col-lg-8 offset-lg-2">
                    <h3 class="text-center">No data found</h3>
                </div>
            </div>
        </section>
    @else
        <section class="section section-with-bg">
            <div class="container">
                <div class="col-lg-6 offset-lg-3 d-flex justify-content-center align-items-center flex-column">
                    <h3 class="text-center">{{$data['title']}}</h3>
                </div>
            </div>
            <div class="overlay"></div>
        </section>
        <section class="my-5 py-5">
            <div class="container">
                <div class="row">
                    @foreach($data['observations'] as $observation)
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title text-dark text-capitalize">{{$observation->observer->roles[0]->name === 'Teaching Student' ? 'Expert' : $observation->observer->roles[0]->name}} Observation</h3>
                                    <p><small>{{$observation->created_at->format('d/m/Y')}}</small></p>
                                    <hr>
                                    <ul class="list-unstyled">
                                        <li class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="text-muted">{{__('Observer')}}</span>
                                            <span class="text-dark">{{$observation->observer->full_name}}</span>
                                        </li>
                                        @if( $observation->observer->roles[0]->name !== 'Teaching Student')
                                        <li class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="text-muted">{{__('Course Year')}}</span>
                                            <span class="text-dark">{{$observation->course_year}}</span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="text-muted">{{__('Course/Title')}}</span>
                                            <span class="text-dark">{{$observation->observed_course}}</span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="text-muted">{{__('Number of Students')}}</span>
                                            <span class="text-dark">{{$observation->strength}}</span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="text-muted">{{__('Organization')}}</span>
                                            <span class="text-dark">{{$observation->organization}}</span>
                                        </li>
                                        @else
                                            <li class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="text-muted">{{__('Observed')}}</span>
                                                <span class="text-dark">{{$observation->observed->full_name ?? '-'}}</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <a href="{{route('website.observation', ['institute' => $institute->slug, 'user' => $user->slug,'id' => $observation->id, 'type' => $data['type']])}}" class="btn btn-primary">View Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('page-scripts')
@endpush

