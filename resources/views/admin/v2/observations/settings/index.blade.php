@extends('admin.layout.app')

@section('page-title')
    Settings
@endsection

@push('page-styles')
    <style>
        .label-drag-input {
            position: relative;
            width: 100%;
            height: 200px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px dashed #d9d9d9;
            border-radius: 5px;
            cursor: pointer;
            transition: 200ms ease-in;
            background-size: initial;
            background-position: center center;
        }

        .label-drag-input:hover {
            border-color: #0a53be;
            border-radius: 10px;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.3);
        }

        .action-container {
            transition: 300ms ease-in;
        }

        .label-drag-input:hover .action-container {
            scale: 1.2;
        }

        #uploadSlideImage,
        #uploadSlideImageEdit{
            opacity: 0;
            pointer-events: none;
        }


    </style>
@endpush

@section('page-breadcrumb')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if(session()->has('message'))
                        {!! session()->get('message'); !!}
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Observation Timeline Steps</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Activity Questions</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                   <div class="col-lg-12">
                                       <table class="table table-hover table-alternate">
                                           <thead>
                                           <tr>
                                               <th>Sr. No</th>
                                               <th>Step</th>
                                               <th>Action</th>
                                           </tr>
                                           </thead>
                                           <tbody>
                                           @forelse(auth()->user()->observationSteps as $key => $step)
                                               <tr>
                                                   <td>{{$key + 1}}</td>
                                                   <td>{{$step->name}}</td>
                                                   <td>
                                                       <a href="#" class="mr-2"><i class="fas fa-pencil-alt"></i></a>
                                                       <a href="#"><i class="fas fa-trash-alt"></i></a>
                                                   </td>
                                               </tr>
                                           @empty
                                               <tr>
                                                   <td colspan="4">No data found</td>
                                               </tr>
                                           @endforelse
                                           </tbody>
                                       </table>
                                   </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                    <div class="text-right mb-3">
                                        <a href="#" data-target="#importQuestionsModal" class="btn btn-primary" data-toggle="modal"><i class="fas fa-upload"></i> Import Questions</a>
                                    </div>
                                    <table class="table table-hover table-alternate">
                                        <thead>
                                        <tr>
                                            <th>Sr. No</th>
                                            <th>Step</th>
                                            <th>Activity Question</th>
                                            <th>Input Type</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($activity_questions as $key => $question)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$question->observationStep->name}}</td>
                                                <td>{{$question->observationStep->label}}</td>
                                                <td>{{$question->observationStep->input_type}}</td>
                                                <td>
                                                    <a href="#" class="mr-2"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="#"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No data found</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.observations.settings.partials.import-questions')
@endsection

@push('page-scripts')

@endpush