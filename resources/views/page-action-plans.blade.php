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

        .box {
            border-radius: 10px;
            display: inline-block;
            padding: 0.33rem 1rem;
            font-size: 0.7rem;
        }

        .box-red {
            background: red;
            color: #FFF;
        }
        .box-amber {
            background-color: #FFBF00;
            color: #000;
        }
        .box-green {
            background-color: green;
            color: #FFF;
        }
    </style>
@endpush
@section('content')
    @include('website.layout.secondary-navigation')
    @if( empty($action_plans) )
        <section class="section section-with-bg">
            <div class="container">
                <div class="col-lg-6 offset-lg-3 d-flex justify-content-center align-items-center flex-column">
                    <h3 class="text-center">Action Plans</h3>
                </div>
            </div>
            <div class="overlay"></div>
        </section>
        <section class="my-5 py-5">
            <div class="container">
                <div class="col-lg-6 offset-lg-3">
                    <h3 class="text-center">No action plans</h3>
                </div>
            </div>
        </section>
    @else
        <section class="section section-with-bg">
            <div class="container">
                <div class="col-lg-6 offset-lg-3 d-flex justify-content-center align-items-center flex-column">
                    <h3 class="text-center">Action Plans</h3>
                </div>
            </div>
            <div class="overlay"></div>
        </section>
        <section class="section mt-5">
            <div class="container">
                <div class="row">
                    @foreach($action_plans as $plan)
                        <div class="col-lg-8 offset-lg-2">
                            <div class="card text-left">
                                <div class="card-body">
                                    <span class="box box-{{$plan->rating}} mb-3">RAG RATING</span>
                                    <h5 class="card-title"><strong>Date: </strong> {{$plan->date->format('d/M/Y')}}</h5>
                                    <h5 class="card-title"><strong>Professional Standard: </strong> {{$plan->ps}}</h5>
                                    <h5 class="card-title"><strong>Development Point:</strong></h5>
                                    <p class="card-text">{!! $plan->development_point !!}</p>
                                    <h5 class="card-title"><strong>Actions:</strong></h5>
                                    <p class="card-text">{!! $plan->actions !!}</p>
                                    <h5 class="card-title"><strong>Review:</strong></h5>
                                    <p class="card-text">{!! $plan->review !!}</p>
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

