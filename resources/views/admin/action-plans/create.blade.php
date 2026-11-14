@extends('admin.layout.app')

@section('page-title')
    New Action Plan Item
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
                    <div class="card">
                        <form action="{{route('action-plans.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">PS<span class="text-danger">*</span></label>
                                            <input type="number" min="1" required id="ps" name="ps" class="form-control">
                                            <p class="help-block">Standard Number, Value must be numeric</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Date<span class="text-danger">*</span></label>
                                            <input type="date" required id="date" name="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Description <span class="text-danger">*</span></label>
                                            <input type="text" required id="date_description" name="date_description" class="form-control">
                                            <p class="help-block">Should description, Could also include a link to
                                                associated observation, shadow-form etc
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">RAG Rating <span class="text-danger">*</span></label>
                                            <select name="rating" id="rating" class="custom-select">
                                                <option value="">{{__('Select RAG Rating')}}</option>
                                                <option value="red">Red</option>
                                                <option value="amber">Amber</option>
                                                <option value="green">Green</option>
                                            </select>
                                        </div>
                                    </div>
                                    @if( auth()->user()->hasAnyRole(['Link Tutor', 'Mentor']))
                                        <div class="col-lg-4">
                                            <label for="">Select User <span class="text-danger">*</span></label>
                                            <select name="user_id" id="user_id" class="custom-select">
                                                @foreach(\App\Models\User::whereHas('roles', function($q){$q->where('name', 'Teaching Student');})->get() as $user)
                                                    <option value="{{$user->id}}">{{$user->full_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <div class="col-lg-4">
                                            <label for="">Select User <span class="text-danger">*</span></label>
                                            <select readonly="readonly" name="user_id" id="user_id" class="custom-select">
                                                <option value="{{auth()->id()}}">{{auth()->user()->full_name}}</option>
                                            </select>
                                        </div>
                                    @endif
                                </div>
                                <div class="row mt-3 border-top-1">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Development Point<span class="text-danger">*</span></label>
                                            <textarea name="development_point" class="summernote"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Actions<span class="text-danger">*</span></label>
                                            <textarea name="actions" class="summernote"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Review</label>
                                            <textarea name="review" class="summernote"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer justify-content-between">
                                <a href="{{URL::previous()}}" type="button" class="btn btn-default" >Close</a>
                                <button type="submit" class="btn btn-primary">Create Action Plan</button>
                            </div>
                        </form>
                    </div>
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
        minHeight: 100,
      });
    </script>
@endpush