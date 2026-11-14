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
    </style>
@endpush
@section('content')
    @include('website.layout.secondary-navigation')
    @if( empty($observations) )
        <section class="section section-with-bg">
            <div class="container">
                <div class="col-lg-6 offset-lg-3 d-flex justify-content-center align-items-center flex-column">
                    <h3 class="text-center">Feedback</h3>
                </div>
            </div>
            <div class="overlay"></div>
        </section>
        <section class="my-5 py-5">
            <div class="container">
                <div class="col-lg-6 offset-lg-3">
                    <h3 class="text-center">No Data found</h3>
                </div>
            </div>
        </section>
    @else
        <section class="section section-with-bg">
            <div class="container">
                <div class="col-lg-6 offset-lg-3 d-flex justify-content-center align-items-center flex-column">
                    <h3 class="text-center">Feedback</h3>
                </div>
            </div>
            <div class="overlay"></div>
        </section>
        <section class="section mt-5">
            <div class="container">
                <div class="col-lg-10 offset-lg-1">
                    @foreach($observations as $observation)
                        <div class="card card-info shadow border-0 mb-3">
                            <div class="card-header">
                                <h3 class="card-subtitle text-capitalize">{{$observation->observer->roles[0]->name ?? ''}} Observation Feedback</h3>
                                <p class="author card-info mb-0">Author: {{$observation->observer->full_name ?? 'N/A'}}</p>
                                <span class="badge bg-secondary">{{$observation->created_at->format('d/m/Y')}}</span>
                            </div>
                            <div class="card-body">
                                @foreach($observation->details as $detail)
                                    @if($detail->response != '')
                                        <div class="mb-3">
                                            <p class="mb-0">{{$detail->activity}}</p>
                                            <p class="mb-0 text-dark">{!! $detail->response !!}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    @foreach($expert_observations as $observation)
                            <div class="card card-info shadow border-0 mb-3">
                                <div class="card-header">
                                    <h3 class="card-subtitle text-capitalize">Expert Observation Feedback</h3>
                                    <p class="author card-info mb-0">Author: {{$observation->observer->full_name ?? 'N/A'}}</p>
                                    <span class="badge bg-secondary">{{$observation->created_at->format('d/m/Y')}}</span>
                                </div>
                                <div class="card-body">
                                    @foreach($observation->details as $detail)
                                        @if($detail->response != '')
                                            <div class="mb-3">
                                                <p class="mb-0">{{$detail->activity}}</p>
                                                <p class="mb-0 text-dark">{!! $detail->response !!}</p>
                                            </div>
                                        @endif
                                    @endforeach
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

