@extends('sales.layout.app')

@push('page-styles')
    <style>
        .section__hero {
            background: rgb(247, 246, 255);
            background: linear-gradient(356deg, rgba(247, 246, 255, 1) 0%, rgba(225, 225, 255, 1) 50%, rgba(204, 242, 250, 1) 100%);
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .list-group-item--child {
            margin-left: 30px;
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

    </style>
@endpush
@section('content')
    <section class="section section__hero">
        <div class="container">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h1>Keep discussion healthy and constructive</h1>
                <h1><strong>Respect others to earn respect</strong></h1>
                <form action="{{route('forum')}}" method="GET">
                    @csrf
                    <div class=" input-group form-floating mt-5">
                        <input type="text" class="form-control" name="search" value="{{$data['search']}}" id="floatingSearchInput" placeholder="topic title">
                        <label for="floatingSearchInput">Search by Title</label>
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="section section__forums mt-5">
        <div class="container">
            <ul class="list-group">
                @forelse($topics as $key => $topic)
                    <li class="list-group-item d-flex justify-content-between align-items-start">

                        <div class="ms-2 me-auto">
                            <div class="fs-4 mb-0"><a href="{{route('forum.show', ['topic' => $topic->slug])}}">{{$topic->title}}  </a></div>
                            <div class="fs-5">{{$topic->subtitle}}</div>
                            <p class="mt-3">
                                {{$topic->description}}
                            </p>
                        </div>
                        <span class="badge bg-primary rounded-pill">{{$topic->threads->count()}} threads</span>
                    </li>
                    @if( $topic->childTopics->count() > 0 )
                        @foreach($topic->childTopics as $child_topic)
                            <li class="list-group-item list-group-item--child d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fs-4 mb-0"><a href="{{route('forum.show', ['topic' => $child_topic->slug])}}">{{$child_topic->title}}</a></div>
                                    <div class="fs-5">{{$child_topic->subtitle}}</div>
                                    <p class="mt-3">
                                        {{$child_topic->description}}
                                    </p>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{$child_topic->threads->count()}} threads</span>
                            </li>
                            @if( $child_topic->childTopics->count() > 0 )
                                @foreach($child_topic->childTopics as $sub_topic)
                                    <li class="list-group-item list-group-item--child d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fs-4 mb-0"><a href="{{route('forum.show', ['topic' => $sub_topic->slug])}}">{{$sub_topic->title}}</a></div>
                                            <div class="fs-5">{{$sub_topic->subtitle}}</div>
                                            <p class="mt-3">
                                                {{$sub_topic->description}}
                                            </p>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">{{$sub_topic->threads->count()}} threads</span>
                                    </li>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @empty
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            No discussion topics are available
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>
        <div class="container mt-3">
            <div class="row">
                <div class="offset-lg-12 col-sm-12 text-right">
                    <div class="pagination">{{$topics->links()}}</div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-scripts')
@endpush

