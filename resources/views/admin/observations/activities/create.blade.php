@extends('admin.layout.app')

@section('page-title')
    @php
        $observation_mapping = [
	'TEACHER-BEGIN' => 'TEACHER-LECTURE STAGE (BEGINNING)',
	'STD-BEGIN' => 'Student-Lecture Stage (Beginning',
	'TEACHER-MID' => 'Teacher-Lecture Stage (Middle)',
	'STD-MID' => 'Student-Lecture Stage (Middle)',
	'TEACHER-CONCL' => 'Student-Lecture Stage (End)',
	'STD-CONCL' => 'Teacher-Lecture Stage (End)'
];
    @endphp
{{$observation_mapping[$observationStep->name]}}
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
                    @include('admin.common.observation_details')
                </div>
                <div class="col-lg-12">
                    <form action="{{route('observations.activities.store', ['observation' => $observation->id, 'observation_type' => $observation_type->slug, 'observationStep' => $observationStep->slug])}}" method="POST">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-body">
                                @include('admin.common.observation_detail_form')
                            </div>
                            <div class="card-footer">
                                <a href="{{URL::previous()}}" class="btn btn-default">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    {{$observationStep->name === 'STD-CONCL' ? 'Submit' : 'Save & Continue'}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-scripts')

@endpush