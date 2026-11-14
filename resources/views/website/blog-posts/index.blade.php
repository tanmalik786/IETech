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
    <section class="section section-institute-home">
        <div class="container">
            <div class="col-lg-6 offset-lg-3 d-flex flex-column justify-content-center align-items-center">
                <h3 class="text-center">Posts</h3>
                <hr>
                @if(isset($user))
                <p class="author">
                    Authored by
                    <i class="bi bi-person-circle"></i>
                    <span>{{$user->full_name}}</span>
                </p>
                @endif
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <section class="section py-5">
        <div class="container">
            <div class="row mb-2">
                @foreach($posts as $key => $post)
                <div class="col-lg-4">
                    <div class="card">
                        <img src="{{asset('storage/blog-posts/featured-image/' . $post->featuredImage->file_name)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$post->title}}</h5>
                            <p class="card-text">{{$post->excerpt}}</p>
                            <div class="d-flex flex-row align-items-center justify-content-between">
                                @if(isset($user))
                                <a href="{{route('institute.posts.show', ['institute' => $institute->slug, 'user' => $user->slug, 'post_slug' => $post->slug->slug])}}" class="btn btn-primary">{{__('Continue Reading')}}</a>
                                <span class="text-muted">{{$post->created_at->diffForHumans()}}</span>
                                @else
                                    <a href="{{route('institute.posts.show', ['institute' => $institute->slug, 'user' => $post->user->slug, 'post_slug' => $post->slug->slug])}}" class="btn btn-primary">{{__('Continue Reading')}}</a>
                                   <div class="d-flex flex-column align-items-right">
                                       <span class="text-muted">{{$post->user->full_name}}</span> <span class="text-muted"> <small>{{$post->created_at->diffForHumans()}}</small></span>
                                   </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection

@push('page-scripts')
@endpush

