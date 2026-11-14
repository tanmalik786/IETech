@extends('admin.layout.app')

@section('page-title')
    Observation
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Observation Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Trainee teacher observed:</p>
                                            <p class="text-dark m-0">{{$observation->observed->full_name}}</p>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">PSET course and year:</p>
                                            <p class="text-dark m-0">{{$observation->course_year}}</p>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Observed course/ level:</p>
                                            <p class="text-dark m-0">{{$observation->observed_course}}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Date:</p>
                                            <p class="text-dark m-0">{{$observation->date->format('d/m/Y')}}</p>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Number of Learners:</p>
                                            <p class="text-dark m-0">{{$observation->strength}}</p>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Organization:</p>
                                            <p class="text-dark m-0">{{$observation->organization}}</p>
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
                                    @if(count($observation->details) > 0)
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="d-flex align-items-center" style="gap: 0.33rem">
                                                    <h4 class="m-0"><strong>Activity</strong></h4>
                                                    @if( auth()->user()->hasAnyRole(['Link Tutor', 'Mentor']) && $observation->observer_id === auth()->id())
                                                        <a href="{{route('observations.edit', ['observation' => $observation->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
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
                                                                {!! $observation_detail->response !!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
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