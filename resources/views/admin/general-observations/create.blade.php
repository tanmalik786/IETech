@extends('admin.layout.app')

@section('page-title')
    Observation
@endsection

@section('page-subtitle')
@endsection

@push('page-styles')
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
                    <div class="card">
                        <form method="POST" action="{{route('expert.activity.store', ['observation' => $observation->id])}}">
                            <div class="card-body">
                                @csrf
                                @foreach($questions as $key => $question)
                                    <div class="form-row py-2">
                                        <label for="" class="col-lg-6">{{$question['label']}}</label>
                                        <input type="hidden" name="activities[{{$key}}]" value="{{$question['label']}}">
                                        @switch($question['input_type'])
                                            @case('text')
                                            <div class="col-lg-3">
                                                <input class="form-control" type="text" required name="responses[{{$key}}]" value="{{$observation->details->where('activity', $question['label'])->pluck('response')->first() ?? ''}}" placeholder="{{$question['placeholder']}}">
                                            </div>
                                            @break
                                            @case('textarea')
                                            <div class="col-lg-12">
                                                <textarea name="responses[{{$key}}]" class="form-control" id="" cols="30" rows="3">{{$observation->details->where('activity', $question['label'])->pluck('response')->first() ?? ''}}</textarea>
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
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" {{$observation->details->where('activity', $question['label'])->pluck('response')->first() && $observation->details->where('activity', $question['label'])->pluck('response')->first() == $option['value'] ? 'checked' : ''}} name="responses[{{$key}}]" id="exampleRadios1{{$key}}{{$option_key}}" value="{{$option['value']}}" {{$option_key == 0 ? 'checked' : ''}}>
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
                                <a class="btn btn-default" href="{{URL::Previous()}}">Cancel</a>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('page-scripts')
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
@endpush