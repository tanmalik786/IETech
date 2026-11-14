@extends('website.layout.app')

@push('page-styles')
    <style>
        .section-institute-home {
            background-image: url("{{asset('images/inst-bg.jpg')}}");
            background-position: center center;
            background-size: cover;
            position: relative;
        }

        .section-institute-home .col-lg-6 {
            min-height: 20rem;
            color: #fff;
            letter-spacing: 0.6rem;
        }

        .section-institute-home h3 {
            font-size: 2.5rem;
            z-index: 1;
        }

        .section-institute-home .overlay {
            background-color: rgba(0,0,0,0.7);
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .heading {
            font-size: 1.5rem;
            letter-spacing: 0.33rem;
        }

        .heading-bordered {
            padding-bottom: 0.5rem;
            border-bottom: 3px solid #000;
        }

        a.card {
            transition: 50ms ease-in;
            border-color: transparent;
            box-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }

        a.card:hover {
            box-shadow: 3px 3px 10px rgba(0,0,0,0.1);
        }
        .author {
            z-index: 1;
            letter-spacing: normal;
        }

        .author span {
            font-weight: bold;
        }

    </style>
@endpush
@section('content')
    <section class="section section-institute-home" style="background-image: url('{{asset('storage/blog-posts/featured-image/' . $post->featuredImage->file_name)}}')">
        <div class="container">
            <div class="col-lg-6 offset-lg-3 d-flex flex-column justify-content-center align-items-center">
                <h3 class="text-center">{{$post->title}}</h3>
                <hr>
                <p class="author">
                    Authored by
                    <i class="bi bi-person-circle"></i>
                    <span>{{$user->full_name}}</span> {{$post->created_at->diffForHumans()}}.
                </p>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <section class="section py-5">
        <div class="container">
            <div class="row mb-2">
                {!! $post->content !!}
            </div>
        </div>
    </section>
@endsection

@push('page-scripts')
@endpush

