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
    </style>
@endpush
@section('content')
    <section class="section section__hero">
        <div class="container">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h1><strong>{{$topic->title}}</strong></h1>
                <h4>{{$topic->description}}</h4>
                <form action="{{route('forum')}}" method="GET">
                    @csrf
                    <div class=" input-group form-floating mt-5">
                        <input type="text" class="form-control" name="search" value="{{$data['search']}}" id="floatingSearchInput" placeholder="topic title">
                        <label for="floatingSearchInput">Search threads by title</label>
                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="section section__forums mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <p class="text-capitalize">Filter by Tags:</p>
                    <ul class="list-unstyled">
                        @foreach($tags as $tag)
                            @foreach(explode(' ', $tag) as $tagname)
                                <li class="mb-1">
                                    <a class="text-capitalize {{$data['tag'] == $tagname ? 'text-primary' : 'text-muted'}}" href="{{route('forum.show', ['topic' => $topic->slug, 'tag' => $tagname])}}">{{$tagname}}</a>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-10">
                    @if( auth()->user() )
                        <button class="btn btn-primary float-end" data-bs-target="#addThread" data-bs-toggle="modal">
                            <i class="bi bi-plus-lg"></i>
                            New Thread
                        </button>
                    @else
                        <a class="btn btn-primary float-end" href="{{route('login')}}">
                            <i class="bi bi-plus-lg"></i>
                            New Thread
                        </a>
                    @endif
                    <div class="clearfix"></div>
                    <ul class="list-group mt-3">
                        @forelse($threads as $key => $thread)
                            <li class="list-group-item d-flex justify-content-between align-items-start">

                                <div class="ms-2 me-auto w-100">
                                    <div class="fs-4 mb-0"><a href="{{route('threads.show', ['thread' => $thread->slug])}}">{{$thread->title}}  </a></div>
                                    <p class="mt-3">
                                        {{$thread->content}}
                                    </p>
                                    <hr>
                                    <strong class="text-muted">{{$thread->replies()->count()}} replies</strong>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    There aren't any threads in this topic, Start by <a href="#" data-bs-target="#addThread" data-bs-toggle="modal">adding one</a>.
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
                <div class="container mt-3">
                    <div class="row">
                        <div class="offset-lg-12 col-sm-12 text-right">
                            <div class="pagination">{{$threads->links()}}</div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    @include('sales.forum.threads.add')
@endsection

@push('page-scripts')
@endpush

