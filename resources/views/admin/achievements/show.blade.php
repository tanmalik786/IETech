@extends('admin.layout.app')

@section('page-title')
    Continuous Professional Development (CPD)
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
                                <h4>{{$post->title}}</h4>
                                <p>{{$post->category}}</p>
                                <p>Created at: {{$post->created_at->format('d/m/Y')}}</p>
                                <p>Completed at: {{\Carbon\Carbon::parse($post->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first())->format('d F Y')}}</p>
                                <p>Duration: {{$post->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first() != null ? "Duration {$post->postMetas->where('meta_key', 'duration_hours')->pluck('meta_value')->first()} Hours, " : ""}}
                                    {{$post->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first() != null ? "{$post->postMetas->where('meta_key', 'duration_minutes')->pluck('meta_value')->first()} minutes" : ""}}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-scripts')

@endpush