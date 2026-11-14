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
    </style>
@endpush
@section('content')
    <section class="section section-institute-home">
        <div class="container">
            <div class="col-lg-6 offset-lg-3 d-flex justify-content-center align-items-center">
                <h3 class="text-center">Institute of Emerging Technologies</h3>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <section class="py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h3 class="m-auto text-dark heading heading-bordered d-inline-block">Portfolios</h3>
                </div>
            </div>
            <div class="row my-5 py-5">
                @forelse($users as $user)
                <div class="col-lg-3">
                    <a href="{{route('portfolio.user', ['user' => $user->slug])}}" class="card">
                        @if($user->profileImage)
                            <img class="portrait-img" src="{{asset('storage/media/' . $user->profileImage->file_name)}}" alt="{{$user->slug}}">
                        @else
                            <img  src="https://images.pexels.com/photos/3748221/pexels-photo-3748221.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="" class="portrait-img">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{$user->first_name}}, {{$user->last_name}}</h5>
                            <p class="card-text">{{$user->tagline}}</p>
                        </div>
                    </a>
                </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('page-scripts')
@endpush

