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
            margin-top: 1rem;
        }

        .row-inverted:not(:last-of-type) {
            margin-bottom: 1rem;
        }

        .card .card-answer {
            padding-left: 1.5rem;
        }

        .card {
            border-bottom: 1px dotted #d9d9d9 !important;
            border-right: 1px dotted #d9d9d9 !important;
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

        .bordered {
            border-right: 1px solid #d9d9d9 !important;
        }

        .list-icon-wrapper {
            min-width: 10rem;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3rem;
            max-height: 80px;
            padding-top: 15px;
        }
    </style>
@endpush
@section('content')
    @include('website.layout.secondary-navigation')
    @if( empty($data['observation']) )
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
                <div class="col-lg-6 offset-lg-3">
                    <h3 class="text-center">No data found</h3>
                </div>
            </div>
        </section>
    @else
        <section class="section section-with-bg">
            <div class="container">
                <div class="col-lg-6 offset-lg-3 d-flex justify-content-center align-items-center flex-column">
                    <h3 class="text-center">{{$data['title']}}</h3>
                    <span class="text-white" style="z-index: 1;">{{$data['observation']->date->format('d/m/Y')}}</span>
                </div>
            </div>
            <div class="overlay"></div>
        </section>
        <section class="section bg-dark" style="padding-top: 3rem;padding-bottom: 3rem">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 offset-lg-2">
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center justify-content-between mb-1">
                                <span class="text-white">{{__('Observer')}}</span>
                                <span class="text-white fw-bold">{{$data['observation']->observer->full_name}}</span>
                            </li>
                            @if( $data['title'] == 'Expert Observation')
                                <li class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="text-white">{{__('Course Year')}}</span>
                                    <span class="text-white fw-bold">{{$data['observation']->course_year}}</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="text-white">{{__('Course/Title')}}</span>
                                    <span class="text-white fw-bold">{{$data['observation']->observed_course}}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center justify-content-between mb-1">
                                <span class="text-white">{{__('Teacher Observed')}}</span>
                                <span class="text-white fw-bold d-flex flex-row align-items-center gap-1"><i class="bi bi-person-circle mr-2"></i> {{$data['observation']->observed->full_name}}</span>
                            </li>
                            @if( $data['title'] == 'Expert Observation')
                                <li class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="text-white">{{__('Number of Students')}}</span>
                                    <span class="text-white fw-bold">{{$data['observation']->strength}}</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="text-white">{{__('Organization')}}</span>
                                    <span class="text-white fw-bold">{{$data['observation']->organization}}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-3">
            <div class="container">
                <div class="row">
                    @foreach($data['observation']->details as $detail)
                        @if( $detail->response !== '' )
                            <div class="row row-inverted">
                                <div class="col-lg-8 offset-lg-2">
                                    <div class="d-flex flex-row w-100">
                                        <div class="list-icon-wrapper bg-primary">
                                            <i class="bi bi-chat-left text-white"></i>
                                        </div>
                                        <div class="card card-quote border-0">
                                            <div class="card-body">
                                                <p class="text-dark mb-0">{{$detail->activity}}?</p>
                                                <p class="text-primary mb-3 mt-0">
                                                    <i class="bi bi-calendar-check mr-1"></i> {{$detail->created_at->format('d/m/Y')}}
                                                </p>
                                                <p class="text-dark">{!! $detail->response !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('page-scripts')
@endpush

