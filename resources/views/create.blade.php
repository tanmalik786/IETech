@extends('admin.layout.app')

@section('page-title')
    New Rationale
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
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{route('rationale.store')}}" method="POST">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Trainee teacher observed <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control @error('observed') is-invalid @enderror" name="observed" value="{{auth()->user()->full_name}}" required>
                                            @error('observed')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">PSET Course and Year <span class="text-danger">*</span></label>
                                            <input type="text" name="course_year" class="form-control @error('course_year') is-invalid @enderror">
                                            <p class="help-block">Should be an annual period e.g. 2023-2024</p>
                                            @error('content')
                                            <span class="invalid-feedback">
                                                {{__('Academic Year is required')}}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Observer <span class="text-danger">*</span></label>
                                            <select required name="observer_id" id="observer_id" class="custom-select">
                                                @foreach($observers as $observer)
                                                    <option value="{{$observer->id}}">{{$observer->full_name}} - {{$observer->roles()->pluck('name')->first()}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Observed course/ level<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('observed_course') is-invalid @enderror" name="observed_course" value="" required>
                                            @error('observed_course')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Number of learners<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('strength') is-invalid @enderror" name="strength" value="" required>
                                            @error('strength')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Organization<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('organization') is-invalid @enderror" name="organization" value="" required>
                                            @error('organization')
                                            <span class="invalid-feedback">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Lesson Plan <span class="text-danger">*</span></label>
                                            <input type="url" name="lesson_plan" class="form-control">
                                            <p class="help-block">Dropbox link to your lesson plan</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Purpose of Rationale</label>
                                            <textarea name="purpose" id="" cols="30" rows="10" class="form-control"></textarea>
                                            @error('purpose')
                                            <p class="text-danger">{{$messsage}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">1. Identify any specific needs present in the group.(e.g. SEND/EAL/High Level Learners)</label>
                                            <input type="hidden" name="details[0][statement]" value="1. Identify any specific needs present in the group.(e.g. SEND/EAL/High Level Learners)">
                                            <textarea name="details[0][response]" id="" cols="30" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">2. Purpose and context of the lesson: (e.g introducing a new topic, consolidating prior learning, completing assessment activity)</label>
                                            <input type="hidden" name="details[1][statement]" value="2. Purpose and context of the lesson: (e.g introducing a new topic, consolidating prior learning, completing assessment activity)">
                                            <textarea name="details[1][response]" id="" cols="30" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">3. Links to previous and next lesson</label>
                                            <input type="hidden" name="details[2][statement]" value="3. Links to previous and next lesson">
                                            <textarea name="details[2][response]" id="" cols="30" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">4. Learning Intentions: (What do you want learners to achieve by the end of the session?)</label>
                                            <input type="hidden" name="details[3][statement]" value="4. Learning Intentions: (What do you want learners to achieve by the end of the session?)">
                                            <textarea name="details[3][response]" id="" cols="30" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">5. Maths, English, Digital, ESD and Wider Employability Skills (How have you planned to develop these skills in your learners? Comment on skills relevant to this session.)</label>
                                            <input type="hidden" name="details[4][statement]" value="5. Maths, English, Digital, ESD and Wider Employability Skills (How have you planned to develop these skills in your learners? Comment on skills relevant to this session.)">
                                            <textarea name="details[4][response]" id="" cols="30" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{URL::Previous()}}" class="btn btn-default">Cancel</a>
                                <button type="submit" class="btn btn-primary">{{isset($post) ? 'Update' : 'Save'}}</button>
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