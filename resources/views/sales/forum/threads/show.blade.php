@extends('sales.layout.app')

@push('page-styles')
    <style>
        .section__hero {
            background: rgb(247, 246, 255);
            background: linear-gradient(356deg, rgba(247, 246, 255, 1) 0%, rgba(225, 225, 255, 1) 50%, rgba(204, 242, 250, 1) 100%);
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .section__hero__appui {
            max-width: 450px;
            margin: 0 auto;
        }

        .section__hero__appui img {
            width: 100%;
        }

        h1, h2, p {
            color: #333;
        }

        .software-ui {
            background: rgb(247, 246, 255);
            background: linear-gradient(356deg, rgba(247, 246, 255, 1) 0%, rgba(225, 225, 255, 1) 50%, rgba(204, 242, 250, 1) 100%);
            padding: 3rem;
            border-radius: 3rem;
        }

        .software-ui img {
            width: 100%;
        }

        .pagination > nav {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
        }

        .pagination > nav:nth-child(2) {
            display: flex;
            flex-direction: column;
        }

        .pagination svg {
            width: 25px;
        }

        .list--reply--header {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-bottom: 10 fpx;
        }

        .list--reply--header img {
            max-width: 50px;
            margin-right: 5px;
        }

        .reply--avatar {
            border-radius: 100%;
            background: lightblue;
            width: 40px;
            height: 40px;
            font-size: 18px;
            color: #FFF;
            text-transform: uppercase;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
        }
    </style>
@endpush
@section('content')
    <section class="section section__hero">
        <div class="container">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h1><strong>{{$thread->title}}</strong></h1>
                <h4>{{$thread->content}}</h4>
                <hr>
                <a class="btn btn-primary" href="#replyBox">Reply</a>
            </div>
        </div>
    </section>

    <section class="section section__forums mt-5">
        <div class="container">
            <div class="row mb-3">
                {{--                <div class="col-lg-12">--}}
                {{--                    @if( auth()->user() )--}}
                {{--                        <button class="btn btn-primary float-end" data-bs-target="#addThread" data-bs-toggle="modal">--}}
                {{--                            <i class="bi bi-reply"></i>--}}
                {{--                            Reply--}}
                {{--                        </button>--}}
                {{--                    @else--}}
                {{--                        <a class="btn btn-primary float-end" href="{{route('login')}}">--}}
                {{--                            <i class="bi bi-reply"></i>--}}
                {{--                            Reply--}}
                {{--                        </a>--}}
                {{--                    @endif--}}
                {{--                    <div class="clearfix"></div>--}}
                {{--                </div>--}}

                <div class="col-lg-10">
                    @if($thread->replies()->count() > 0 )
                        <ul class="list-group list-unstyled list--replies mt-3">
                            @foreach($thread->replies as $key => $reply)
                                <li class="list--reply mb-2">
                                    <div class="list--reply--header">
                                        <div class="d-flex flex-row">
                                <span class="reply--avatar">
                                    {{$reply->user->first_name[0]}}{{$reply->user->last_name[0]}}
                                </span>
                                            <h3 class="reply--author">{{$reply->user->full_name}}</h3>
                                        </div>
                                        <div class="reply--date">
                                            {{$reply->updated_at->diffForHumans()}}
                                        </div>
                                    </div>
                                    <div class="list--reply--body">
                                        {{$reply->content}}
                                    </div>
                                    <hr>
                                </li>
                            @endforeach
                        </ul>
                    @else
                    @endif
                    <hr>
                    <form id="replyBox" action="{{route('reply.store', ['thread' => $thread])}}" class="" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" id="" cols="30" rows="3" class="form-control"></textarea>
                            <button class="btn btn-primary mt-3">Submit Reply</button>
                        </div>
                    </form>
                </div>
            </div>
    </section>
@endsection

@push('page-scripts')
@endpush

