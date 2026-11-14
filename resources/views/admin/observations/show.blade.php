@extends('admin.layout.app')

@section('page-title')
    Observation Detail
@endsection

@push('page-styles')
@endpush

@section('page-breadcrumb')
@endsection

@section('content')
    @php
        $color_step_mapping = [
	'Expert Questionnaire' => 'bg-gradient-info',
	'Observation Questionnaire' => 'bg-gradient-info',
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
                <div class="col-md-12">
                    @include('admin.common.observation_details')
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
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Remarks</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    @if(count($observation->details) > 0)
                                        @if($observation->type->name == 'shadow')
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex flex-row align-items-center mb-3" style="gap: 0.33rem">
                                                        <h3 class="text-dark">Timeline</h3>
                                                        <a href="{{route('admin.shadow-form.create', ['observation' => $observation->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="timeline">
                                                        @php
                                                            $observationSteps = [
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
                                                        @foreach($observationSteps as $step)
                                                            <div class="time-label">
                                                                <span class="{{$color_step_mapping[$step['step']]}}">{{$step['display_name']}}</span>
                                                            </div>
                                                            @foreach(\App\Models\ObservationDetail::where('step', $step['step'])->where('observation_id', $observation->id)->get() as $observation_detail)
                                                                <div>
                                                                    <i class="fas fa-question bg-gradient-gray"></i>
                                                                    <div class="timeline-item">
                                                                        <span class="time"><i class="fas fa-clock"></i> {{\Carbon\Carbon::parse($observation_detail->created_at)->format('g:i A')}}</span>
                                                                        <h3 class="timeline-header">{{$observation_detail->activity}}</h3>
                                                                        <div class="timeline-body">
                                                                            {{$observation_detail->response}}
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
                                                <div class="col-md-12 mb-3">
                                                    <div class="d-flex align-items-center" style="gap: 0.33rem">
                                                        <h4 class="m-0"><strong>Activity</strong></h4>
                                                        @if($observation->type->name == 'expert')
                                                            <a href="{{route('expert.activity.create', ['observation' => $observation->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                        @elseif($observation->type->name == 'general')
                                                            <a href="{{route('general.activity.create', ['observation' => $observation->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    @foreach(\App\Models\ObservationDetail::where('observation_id', $observation->id)->get() as $observation_detail)
                                                        <div class="card mb-3">
                                                            <div class="card-header d-flex flex-column">
                                                                <p class="m-0">{{$observation_detail->activity}}</p>
                                                                <span class="time" style="font-size: 0.75rem;color: darkgrey;"><i class="fas fa-calendar"></i> {{\Carbon\Carbon::parse($observation_detail->created_at)->format('d F, Y')}}</span>
                                                            </div>
                                                            <div class="card-body">
                                                                <p class="lead">
                                                                    {{$observation_detail->response}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex align-items-center justify-content-center w-50" style="margin: 0 auto;padding-top: 5rem;padding-bottom: 5rem">
                                                    <div class="card">
                                                        <div class="card-body align-items-center d-flex flex-column">
                                                            <i class="fas fa-folder" style="font-size: 3rem; margin-bottom: 0.33rem; color: #d9d9d9;"></i>
                                                            <p class="lead text-center">This observation do not have any activity, Start by click on Add Activity button</p>
                                                            @switch($observation->type->name)
                                                                @case('shadow')
                                                                <a href="{{route('admin.shadow-form.create', ['observation' => $observation->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Activity</a>
                                                                @break
                                                                @case('expert')
                                                                <a href="{{route('expert.activity.create', ['observation' => $observation->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Activity</a>
                                                                @break
                                                                @case('general')
                                                                <a href="{{route('general.activity.create', ['observation' => $observation->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Activity</a>
                                                                @break
                                                            @endswitch

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    @if(count($observation->remarks) > 0)
                                        <div class="timeline">
                                            @foreach($observation->remarks as $remark)
                                                <div class="time-label">
                                                    <span class="bg-gradient-primary">{{$remark->created_at->format('d F, Y g:i A')}}</span>
                                                </div>
                                                <div>
                                                    <i class="fas fa-comment-alt bg-gradient-gray"></i>
                                                    <div class="timeline-item">
                                                        <div class="timeline-body">
                                                            {{$remark->response}}
                                                        </div>
                                                        <div class="timeline-footer">
                                                            <i class="fas fa-user"></i><small class="ml-1">{{auth()->user()->full_name}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-center align-items-center flex-column py-5">
                                            <i class="fas fa-folder" style="font-size: 4rem; color: lightgrey"></i>
                                            <h5 class="text-muted">No Remarks found</h5>
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