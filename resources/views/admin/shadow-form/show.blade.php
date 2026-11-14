@extends('admin.layout.app')

@section('page-title')
    Shadow Form Detail
@endsection

@push('page-styles')
@endpush

@section('page-breadcrumb')
@endsection

@section('content')
    @php
        $color_step_mapping = [
	'TEACHER-BEGIN' => 'bg-gradient-info',
	'STD-BEGIN' => 'bg-gradient-info',
	'TEACHER-MID' => 'bg-gradient-blue',
	'STD-MID' => 'bg-gradient-blue',
	'TEACHER-CONCL' => 'bg-gradient-red',
	'STD-CONCL' => 'bg-gradient-red',
];
    @endphp
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Observation Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Shadowing:</p>
                                            <p class="text-dark m-0">{{$shadow_form->observed->full_name ?? 'N/A'}}</p>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Year Group:</p>
                                            <p class="text-dark m-0">{{$shadow_form->year_group}}</p>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Number of Students:</p>
                                            <p class="text-dark m-0">{{$shadow_form->number_of_students}}</p>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Time:</p>
                                            <p class="text-dark m-0">{{\Carbon\Carbon::parse($shadow_form->time)->format('g:i A')}}</p>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Number of Staff:</p>
                                            <p class="text-dark m-0">{{$shadow_form->number_of_staff}}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Date:</p>
                                            <p class="text-dark m-0">{{\Carbon\Carbon::parse($shadow_form->date)->format('d F Y')}}</p>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Course Title:</p>
                                            <p class="text-dark m-0">{{$shadow_form->course_title}}</p>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Learning Intentions:</p>
                                            <p class="text-dark m-0">{{$shadow_form->outcome}}</p>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Pre-requisite knowledge:</p>
                                            <p class="text-dark m-0">{{$shadow_form->pre_req}}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Timeline</a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Remarks</a>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    @if(count($shadow_form->details) > 0)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex flex-row align-items-center mb-3" style="gap: 0.33rem">
                                                    <h3 class="text-dark">Timeline</h3>
{{--                                                    <a href="{{route('admin.shadow-form.create', ['observation' => $shadow_form->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit </a>--}}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="timeline">
                                                    @php
                                                        $shadow_form->Steps = [
            [
                'display_name' => 'TEACHER-LECTURE STAGE (BEGINNING)',
                'step' => 'TEACHER-BEGIN',
            ],
            [
                'display_name' => 'Student-Lecture Stage (Beginning)',
                'step' => 'STD-BEGIN',
            ],
            [
                'display_name' => 'Teacher-Lecture Stage (Middle)',
                'step' => 'TEACHER-MID',
            ],
            [
                'display_name' => 'Student-Lecture Stage (Middle)',
                'step' => 'STD-MID',
            ],
            [
                'display_name' => 'Teacher-Lecture Stage (End)',
                'step' => 'TEACHER-CONCL',
            ],
            [
                'display_name' => 'Student-Lecture Stage (End)',
                'step' => 'STD-CONCL',
            ]
        ];
                                                    @endphp
                                                    @foreach($shadow_form->Steps as $step)
                                                        <div class="time-label">
                                                            <span class="{{$color_step_mapping[$step['step']]}}">{{$step['display_name']}}</span>
                                                        </div>
                                                        @foreach(\App\Models\ShadowFormDetail::where('step', $step['step'])->where('shadow_form_id', $shadow_form->id)->get() as $shadow_form->_detail)
                                                            <div>
                                                                <i class="fas fa-question bg-gradient-gray"></i>
                                                                <div class="timeline-item">
                                                                    <span class="time"><i class="fas fa-clock"></i> {{\Carbon\Carbon::parse($shadow_form->_detail->created_at)->format('g:i A')}}</span>
                                                                    <h3 class="timeline-header">{{$shadow_form->_detail->activity}}</h3>
                                                                    <div class="timeline-body">
                                                                        {{$shadow_form->_detail->response}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex align-items-center justify-content-center w-50" style="margin: 0 auto;padding-top: 5rem;padding-bottom: 5rem">
                                                    <div class="card">
                                                        <div class="card-body align-items-center d-flex flex-column">
                                                            <i class="fas fa-folder" style="font-size: 3rem; margin-bottom: 0.33rem; color: #d9d9d9;"></i>
                                                            <p class="lead text-center">Shadow form does not have any activity, Start by click on Add Activity button</p>
                                                            <a href="{{route('admin.shadow-form.create', ['observation' => $shadow_form->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Activity</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('page-scripts')
@endpush