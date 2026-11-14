@extends('admin.layout.app')

@section('page-title')
    Edit Expert Observation
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
                    <form action="{{route('expert.observations.update', ['expert_observation' => $observation->id])}}" method="POST">
                        <div class="card">
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Observer</label>
                                            <input type="hidden" name="observer_id" value="{{$observation->observer_id}}">
                                            <input type="text" value="{{$observation->observer->full_name ?? ''}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Observee</label>
                                            <select name="observed_id" id="" class="custom-select">
                                                @foreach( $teachers as $teacher)
                                                    <option {{$observation->observed_id == $teacher->id ? 'selected' : ''}}  value="{{$teacher->id}}">{{ $teacher->full_name  }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" value="{{$observation->date->format('Y-m-d') ?? ''}}" required class="form-control">
                                        </div>
                                    </div>
                                </div>
                                @foreach($sections as $k => $section)
                                    <hr class="my-3">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <label>{{$section['title']}}</label>
                                        </div>
                                    </div>
                                    @foreach($section['questions'] as $key => $question)
                                        <div class="form-row py-2">
                                            <label for="" class="col-lg-12">{{$question['label']}}</label>
                                            <input type="hidden" name="activities[{{$k}}{{$key}}]" value="{{$question['label']}}">
                                            @switch($question['input_type'])
                                                @case('text')
                                                <div class="col-lg-3">
                                                    <input class="form-control" type="text" required name="responses[{{$k}}{{$key}}]" value="{{$observation->details->where('activity', trim($question['label']))->pluck('response')->first() ?? ''}}" placeholder="{{$question['placeholder']}}">
                                                </div>
                                                @break
                                                @case('textarea')
                                                <div class="col-lg-12">
                                                    <textarea name="responses[{{$k}}{{$key}}]" class="form-control" id="" cols="30" rows="3">{{$observation->details->where('activity', trim($question['label']))->pluck('response')->first() ?? ''}}</textarea>
                                                </div>
                                                @break
                                                @case('radio')
                                                <div class="col-lg-3">
                                                    @foreach($question['options'] as $option_key => $option)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="responses[{{$key . $k}}]" id="exampleRadios1{{$key . $k}}{{$option_key}}" value="{{$option['value']}}" {{$observation->details->where('activity', $question['label'])->pluck('response')->first() && $observation->details->where('activity', $question['label'])->pluck('response')->first() == $option['value'] ? 'checked' : ''}}>
                                                            <label class="form-check-label" for="exampleRadios1{{$key . $k}}{{$option_key}}">
                                                                {{$option['label']}}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @break
                                                @case('checkbox')
{{--                                                <div class="col-lg-3">--}}
{{--                                                    @foreach($question['options'] as $option_key => $option)--}}
{{--                                                        @php--}}
{{--                                                            $selected_options = explode(',', $observation->details->where('activity', $question['label'])->pluck('response')->first());--}}
{{--                                                        @endphp--}}
{{--                                                        <div class="form-check">--}}
{{--                                                            <input class="form-check-input" type="checkbox" {{ in_array($option['value'], $selected_options) ? 'checked' : ''}} name="responses[{{$key}}][]" id="exampleRadios1{{$key}}{{$option_key}}" value="{{$option['value']}}" >--}}
{{--                                                            <label class="form-check-label" for="exampleRadios1{{$key}}{{$option_key}}">--}}
{{--                                                                {{$option['label']}}--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
{{--                                                    @endforeach--}}
{{--                                                </div>--}}
                                                @break
                                            @endswitch
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <a href="{{URL::previous()}}" class="btn btn-secondary" >Cancel</a>
                                <button class="btn btn-primary">Update Observation</button>
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