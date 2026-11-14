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
                    <h3 class="text-center">{{__('Shadow Form')}}</h3>
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
                    <h3 class="text-center">{{__('Shadow Form')}}</h3>
                    <span class="text-white" style="z-index: 1;">{{$data['observation']->created_at->format('d/m/Y')}}</span>
                </div>
            </div>
            <div class="overlay"></div>
        </section>
        <section class="section bg-dark" style="padding-top: 5rem;padding-bottom: 5rem">
            <div class="container">
                <div class="col-lg-10 offset-lg-1">
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="lead text-white mb-1">
                                Observed: {{$data['observation']->observed->full_name ?? '-'}}
                            </p>
                            <p class="lead text-white mb-1">
                                Year Group: {{$data['observation']->year_group}}
                            </p>
                            <p class="lead text-white mb-1">
                                Number of Students: {{$data['observation']->number_of_students}}
                            </p>
                            <p class="lead text-white mb-1">
                                Number of Staff: {{$data['observation']->number_of_staff}}
                            </p>
                        </div>
                        <div class="col-lg-5">
                            <p class="lead text-white mb-1">
                                Course Title: {{$data['observation']->course_title}}
                            </p>
                            <p class="lead text-white mb-1">
                                Learning Intentions: {{$data['observation']->outcome}}
                            </p>
                            <p class="lead text-white mb-1">
                                Pre-requisite knowledge: {{$data['observation']->pre_req}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @php

            $observationSteps = [
                    'Beginning' => [
[
                        'display_name' => 'TEACHER-LECTURE',
                        'step' => 'TEACHER-BEGIN',
                    ],
                    [
                        'display_name' => 'Student-Lecture',
                        'step' => 'STD-BEGIN',
                    ],
],
                    'Middle' => [
                                            [
                                            'display_name' => 'Teacher-Lecture',
                                            'step' => 'TEACHER-MID',
                                        ],
                                        [
                                            'display_name' => 'Student-Lecture',
                                            'step' => 'STD-MID',
                                        ],
                    ],
                    'End' => [
                                    [
                                            'display_name' => 'Teacher-Lecture',
                                            'step' => 'TEACHER-CONCL',
                                        ],
                                        [
                                            'display_name' => 'Student-Lecture',
                                            'step' => 'STD-CONCL',
                                        ]
                    ]
                ];
        @endphp
        @foreach($observationSteps as $key => $step)
            <section class="section py-5 mt-4">
                <div class="container">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <h3 class="text-center text-dark">{{$key}}</h3>
                            </div>
                            @foreach($step as $stage)
                                <div class="text-container col-lg-6">
                                    <p class="text-dark lead text-uppercase fw-bold">{{$stage['display_name']}}</p>
                                    <ul class="list-unstyled">
                                        @foreach(\App\Models\ShadowFormDetail::where('shadow_form_id', $data['observation']->id)->where('step', $stage['step'])->get() as $detail)
                                            <div class="card card-quote border-0 mb-3">
                                                <div class="card-body">
                                                    <p class="text-muted mb-2">{{$detail->activity}}</p>
                                                    <p class="text-dark pl-0 lead">{{$detail->response}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif
@endsection

@push('page-scripts')
@endpush

