@extends('admin.layout.app')

@section('page-title')
    Blog Posts
@endsection

@push('page-styles')
    <style>
        .label-drag-input {
            position: relative;
            width: 100%;
            height: 200px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px dashed #d9d9d9;
            border-radius: 5px;
            cursor: pointer;
            transition: 200ms ease-in;
            background-size: initial;
            background-position: center center;
        }

        .label-drag-input:hover {
            border-color: #0a53be;
            border-radius: 10px;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.3);
        }

        .action-container {
            transition: 300ms ease-in;
        }

        .label-drag-input:hover .action-container {
            scale: 1.2;
        }

        #uploadSlideImage,
        #uploadSlideImageEdit {
            opacity: 0;
            pointer-events: none;
        }


    </style>
@endpush

@section('page-breadcrumb')
    <div class="text-right">
        @if( auth()->user()->hasRole('Teaching Student'))
        <a href="{{route('admin.blog-posts.create')}}"
           class="btn btn-primary"><i class="fas fa-plus"></i> New Blog Post
        </a>
        @endif
    </div>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Title</th>
                                    @if( ! auth()->user()->hasRole('Teaching Student'))
                                        <th>Author</th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($posts as $key => $post)
                                    <tr>
                                        <td class="text-center">{{$key + $posts->firstItem()}}</td>
                                        <td>{{$post->title}}</td>
                                        @if( ! auth()->user()->hasRole('Teaching Student'))
                                        <td>{{$post->user->full_name}}</td>
                                        @endif
                                        <td>
                                            @if( auth()->user()->hasRole('Teaching Student'))
                                            <a href="{{route('admin.blog-posts.edit', ['post' => $post->id])}}"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endif
                                            <a target="_blank" href="{{route('institute.posts.show', ['institute' => auth()->user()->institute->slug, 'user' => auth()->user()->slug, 'post_slug' => $post->slug->slug])}}" class="btn btn-icon">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if( auth()->user()->hasRole('Teaching Student'))
                                            <a href="javascript:void(0)" data-toggle="modal" data-action="{{route('admin.blog-posts.destroy', ['post' => $post->id])}}" data-target="#deleteRecordModal" class="btn btn-icon text-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No data found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                {!!  $posts->links() !!}
                                </tfoot>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-scripts')
@endpush