@extends('admin.layout.app')

@section('page-title')
    Logged Teaching Hours
@endsection

@push('page-styles')
@endpush

@section('page-breadcrumb')
@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Basic Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Name:</p>
                                            <p class="text-dark m-0">{{$post->title}}</p>
                                        </li>
                                        <li class="mb-3 d-flex justify-content-between align-items-center">
                                            <p class="m-0">Academic Year:</p>
                                            <p class="text-dark m-0">{{$post->content}}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-dark">Logs</h3>
                </div>
                <div class="col-md-12">
                    <div class="timeline">
                        @foreach($post->teachingLogs as $log)
                            <div class="time-label">
                                <span class="bg-gradient-primary">{{$log->week_beginning}}</span>
                            </div>
                            <div>
                                <i class="fas fa-paperclip bg-gradient-yellow"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> {{\Carbon\Carbon::parse($log->created_at)->format('g:i A')}}</span>
                                    <h3 class="timeline-header">{{$log->hours_of_contact_time}}</h3>
                                    <div class="timeline-body">
                                        {{$log->description}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection

@push('page-scripts')
@endpush