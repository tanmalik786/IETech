@extends('admin.layout.app')

@section('page-title')
    Reflection
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
                        <div class="card-header">
                            <div class="d-flex justify-content-start align-items-start flex-column">
                                <h4>{{$reflection->title}}</h4>
                                <p>{{$reflection->created_at->format('d/m/Y')}}</p>
                                <a href="{{$reflection->link}}" target="_blank" class="btn btn-outline-primary btn-sm">View</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Comments:</p>
                            {!! $reflection->comments !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-scripts')

@endpush