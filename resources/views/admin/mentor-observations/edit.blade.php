@extends('admin.layout.app')

@section('page-title')
    Edit Observation
@endsection

@section('page-subtitle')
@endsection

@push('page-styles')
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/summernote/summernote.min.css')}}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        tr[data-day="Monday"] {
            background: rgba(124, 166, 217, 0.3)
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
                    <form action="{{route('mentor-observation.update', ['observation' => $observation])}}" method="POST">
                        <div class="card">
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Teacher observed</label>
                                            <input type="text" name="teacher_observed" value="{{$observation->mentorObservation->user->full_name ?? ''}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">PSET course and year</label>
                                            <input type="text" name="year_group" value="{{$observation->mentorObservation->course_year ?? ''}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" value="{{$observation->mentorObservation?->date?->format('Y-m-d') ?? ''}}" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Observed course/ level <span class="text-danger">*</span></label>
                                            <input type="text" name="course_title" value="{{$observation->mentorObservation->observed_course ?? ''}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Number of Learners</label>
                                            <input type="text" name="number_of_students" value="{{$observation->mentorObservation->strength ?? ''}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Organization</label>
                                            <input type="text" name="organization" value="{{$observation->mentorObservation->organization ?? ''}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                @foreach($questions as $key => $question)
                                    <div class="form-row py-2">
                                        <label for="" class="col-lg-6">{{$question['label']}}</label>
                                        <input type="hidden" name="activities[{{$key}}]" value="{{$question['label']}}">
                                        @switch($question['input_type'])
                                            @case('text')
                                            <div class="col-lg-3">
                                                <input class="form-control" type="text" required name="responses[{{$key}}]" value="{{$observation->details->where('activity', trim($question['label']))->pluck('response')->first() ?? ''}}" placeholder="{{$question['placeholder']}}">
                                            </div>
                                            @break
                                            @case('textarea')
                                            <div class="col-lg-12">
                                                <textarea name="responses[{{$key}}]" class="form-control" id="" cols="30" rows="3">{{$observation->details->where('activity', trim($question['label']))->pluck('response')->first() ?? ''}}</textarea>
                                            </div>
                                            @break
                                            @case('radio')
                                            <div class="col-lg-3">
                                                @foreach($question['options'] as $option_key => $option)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="responses[{{$key}}]" id="exampleRadios1{{$key}}{{$option_key}}" value="{{$option['value']}}" {{$observation->details->where('activity', $question['label'])->pluck('response')->first() && $observation->details->where('activity', $question['label'])->pluck('response')->first() == $option['value'] ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="exampleRadios1{{$key}}{{$option_key}}">
                                                            {{$option['label']}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @break
                                            @case('checkbox')
                                            <div class="col-lg-3">
                                                @foreach($question['options'] as $option_key => $option)
                                                    @php
                                                        $selected_options = explode(',', $observation->details->where('activity', $question['label'])->pluck('response')->first());
                                                    @endphp
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" {{ in_array($option['value'], $selected_options) ? 'checked' : ''}} name="responses[{{$key}}][]" id="exampleRadios1{{$key}}{{$option_key}}" value="{{$option['value']}}" >
                                                        <label class="form-check-label" for="exampleRadios1{{$key}}{{$option_key}}">
                                                            {{$option['label']}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @break
                                        @endswitch
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <a href="{{URL::previous()}}" class="btn btn-secondary" >Cancel</a>
                                <button class="btn btn-primary">Submit Observation</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('page-scripts')
    <script src="{{asset('vendor/adminlte/plugins/summernote/summernote.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
      $('textarea').summernote({
        minHeight: 100
      });
    </script>
@endpush