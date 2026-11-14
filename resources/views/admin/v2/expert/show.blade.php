@extends('admin.layout.app')

@section('page-title')
    Expert Observation
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
                                            <p class="m-0">Observed:</p>
                                            <p class="text-dark m-0">{{$expert_observation->observed != null ? $expert_observation->observed->full_name : 'N/A'}}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Date:</p>
                                            <p class="text-dark m-0">{{$expert_observation->date->format('d/m/Y')}}</p>
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
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    @if(count($expert_observation->details) > 0)
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="d-flex align-items-center" style="gap: 0.33rem">
                                                    <h4 class="m-0"><strong>Activity</strong></h4>
                                                    @if( auth()->user()->hasAnyRole(['Teaching Student']) && $expert_observation->observer_id === auth()->id())
                                                        <a href="{{route('expert.observations.edit', ['expert_observation' => $expert_observation->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                @foreach($expert_observation->details as $expert_observation_detail)
                                                    <div class="card mb-3">
                                                        <div class="card-header d-flex flex-column">
                                                            <p class="m-0">{{$expert_observation_detail->activity}}</p>
                                                            <span class="time" style="font-size: 0.75rem;color: darkgrey;"><i class="fas fa-calendar"></i> {{\Carbon\Carbon::parse($expert_observation_detail->created_at)->format('d F, Y')}}</span>
                                                        </div>
                                                        <div class="card-body">
                                                            <p class="lead">
                                                                {!! $expert_observation_detail->response !!}
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