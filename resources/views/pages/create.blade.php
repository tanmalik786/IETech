@extends('admin.layout.app')

@section('page-title')
    New Page
@endsection

@section('page-subtitle')
@endsection

@push('page-styles')
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/summernote/summernote.min.css')}}">
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
            <form method="POST" class="row" action="{{route('pages.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="">Page Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Featured Image</label>
                                <input type="file" name="featured_image" accept="image/*" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-primary">Save</button>
                            <a class="btn btn-secondary btn-block" href="{{route('pages')}}">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@push('page-scripts')
    <script src="{{asset('vendor/adminlte/plugins/summernote/summernote.min.js')}}"></script>
    <script type="text/javascript">

    $('textarea').summernote({
        minHeight: 100
    });

    </script>
@endpush