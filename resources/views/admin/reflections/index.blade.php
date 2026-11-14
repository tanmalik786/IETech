@extends('admin.layout.app')

@section('page-title')
   Reflections
@endsection

@section('page-subtitle')
    <p>Reflective writing/your thoughts about teaching experience</p>
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
    @if( auth()->user()->hasRole('Teaching Student'))
    <div class="text-right">
        <a href="javascript:void(0)"
           data-target="#addReflection"
           data-toggle="modal"
           class="btn btn-primary"><i class="fas fa-plus"></i> New Reflection
        </a>
    </div>
    @endif
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
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Comments</th>
                                    @if( ! auth()->user()->hasRole('Teaching Student'))
                                    <th>Teaching Student</th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($reflections as $key => $reflection)
                                    <tr>
                                        <td>{{$reflection->created_at->format('d/m/Y')}}</td>
                                        <td>{{$reflection->title}}</td>
                                        <td><a href="{{$reflection->link}}" target="_blank" class="btn btn-outline-primary btn-sm">View</a></td>
                                        <td>{{substr($reflection->comments, 0, 30) . "..."}}</td>
                                        @if( ! auth()->user()->hasRole('Teaching Student'))
                                            <td>{{$reflection->user->full_name}}</td>
                                        @endif
                                        <td>
                                            @if(auth()->user()->hasRole('Teaching Student'))
                                            <a href="#"
                                                data-toggle="modal"
                                                data-target=".editReflection"
                                                data-title="{{$reflection->title}}"
                                                data-link="{{$reflection->link}}"
                                                data-slug="{{$reflection->slug}}"
                                                data-comments="{{$reflection->comments}}"
                                                data-action="{{route('reflections.update', ['id' => $reflection->id])}}"
                                                class="btn btn-icon"
                                            >
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href=""
                                               data-toggle="modal"
                                               data-target="#deleteRecordModal"
                                               data-action="{{route('reflections.destroy', ['id' => $reflection->id])}}"
                                               class="btn btn-icon text-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            @endif
                                                <a href="{{route('reflections.show', ['reflection' => $reflection->id])}}" class="btn btn-icon text-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No data found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    @include('admin.reflections.partials.modals.add')
    @include('admin.reflections.partials.modals.edit')
@endsection

@push('page-scripts')
    <script>
        $('.editReflection').on('show.bs.modal', function(event) {

            const modalEl = $('.editReflection');
            const button = $(event.relatedTarget);
            const action = button.data('action');
            const title = button.data('title');
            const comments = button.data('comments');
            const link = button.data('link');

            modalEl.find('form').attr('action', action);
            modalEl.find('#title').val(title)
            modalEl.find('#comments').val(comments)
            modalEl.find('#link').val(link)

        });

    </script>
@endpush