@extends('admin.layout.app')

@section('page-title')
    Topics (Forum)
@endsection

@push('page-styles')
    <style>
        .tr--child {
            background-color: #f1ecec;
            border-left: 5px solid #827f7f;
        }

        .tr--child td:first-child {
            text-indent: 10px;
        }
    </style>
@endpush

@section('page-breadcrumb')
    <div class="text-right">
        <a data-target="#addTopic" data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus"></i> New Topic</a>
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
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
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-left">Title</th>
                                        {{--                                    <th class="text-left">Subtitle</th>--}}
                                        {{--                                    <th class="text-left">Description</th>--}}
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Threads</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($topics as $key => $topic)
                                    <tr>
                                        <td
                                            @if( $topic->childTopics()->count() > 0)
                                            data-toggle="collapse"
                                            data-target=".child{{$key}}1"
                                            class="accordion-toggle text-left"
                                            @else
                                            class="text-left"
                                            @endif
                                        >
                                            @if( $topic->childTopics()->count() > 0)
                                            <i class="fas fa-plus-circle"></i>
                                            @endif
                                            {{$topic->title}}
                                        </td>
                                        {{--                                        <td class="text-left">{{$topic->subtitle}}</td>--}}
                                        {{--                                        <td class="text-left">{{$topic->description}}</td>--}}
                                        <td class="text-center">{!! $topic->formatted_status !!}</td>
                                        <td class="text-center">{{$topic->threads()->count()}}</td>
                                        <td class="text-center">
                                            <a href="#"
                                               data-target="#editTopic"
                                               data-toggle="modal"
                                               data-title="{{$topic->title}}"
                                               data-subtitle="{{$topic->subtitle}}"
                                               data-description="{{$topic->description}}"
                                               data-parent_id="{{$topic->parent_id}}"
                                               data-action="{{route('superadmin.topics.update', ['topic' => $topic->slug])}}"
                                            ><i class="fas fa-pencil-alt mr-1"></i></a>
                                            <a href="#"
                                               data-toggle="modal"
                                               data-target="#deleteRecordModal"
                                               data-action="{{route('superadmin.topics.destroy', ['topic' => $topic->slug])}}"
                                            ><i class="fas fa-trash-alt text-danger"></i></a>
                                        </td>
                                    </tr>
                                    @if( $topic->childTopics()->count() > 0)
                                        @foreach($topic->childTopics as $child_topic)
                                        <tr class="tr--child child{{$key}}1 collapse">
                                            <td
                                                @if( $child_topic->childTopics()->count() > 0)
                                                data-toggle="collapse"
                                                data-target=".child{{$key}}2"
                                                class="accordion-toggle text-left"
                                                @else
                                                class="text-left"
                                                @endif
                                            >
                                                @if( $child_topic->childTopics()->count() > 0)
                                                    <i class="fas fa-plus-circle"></i>
                                                @endif
                                                {{$child_topic->title}}
                                            </td>
                                            {{--                                        <td class="text-left">{{$child_topic->subtitle}}</td>--}}
                                            {{--                                        <td class="text-left">{{$child_topic->description}}</td>--}}
                                            <td class="text-center">{!! $child_topic->formatted_status !!}</td>
                                            <td class="text-center">{{$child_topic->threads()->count()}}</td>
                                            <td class="text-center">
                                                <a href="#"
                                                   data-target="#editTopic"
                                                   data-toggle="modal"
                                                   data-title="{{$child_topic->title}}"
                                                   data-subtitle="{{$child_topic->subtitle}}"
                                                   data-description="{{$child_topic->description}}"
                                                   data-parent_id="{{$child_topic->parent_id}}"
                                                   data-action="{{route('superadmin.topics.update', ['topic' => $child_topic->slug])}}"
                                                ><i class="fas fa-pencil-alt mr-1"></i></a>
                                                <a href="#"
                                                   data-toggle="modal"
                                                   data-target="#deleteRecordModal"
                                                   data-action="{{route('superadmin.topics.destroy', ['topic' => $child_topic->slug])}}"
                                                ><i class="fas fa-trash-alt text-danger"></i></a>
                                            </td>
                                        </tr>
                                        @if( $child_topic->childTopics()->count() > 0)
                                            @foreach($child_topic->childTopics as $sub_topic)
                                                <tr class="tr--child child{{$key}}2 collapse">
                                                    <td
                                                            class="text-left"
                                                    >
                                                        {{$sub_topic->title}}
                                                    </td>
                                                    {{--                                        <td class="text-left">{{$child_topic->subtitle}}</td>--}}
                                                    {{--                                        <td class="text-left">{{$child_topic->description}}</td>--}}
                                                    <td class="text-center">{!! $sub_topic->formatted_status !!}</td>
                                                    <td class="text-center">{{$sub_topic->threads()->count()}}</td>
                                                    <td class="text-center">
                                                        <a href="#"
                                                           data-target="#editTopic"
                                                           data-toggle="modal"
                                                           data-title="{{$sub_topic->title}}"
                                                           data-subtitle="{{$sub_topic->subtitle}}"
                                                           data-description="{{$sub_topic->description}}"
                                                           data-parent_id="{{$sub_topic->parent_id}}"
                                                           data-action="{{route('superadmin.topics.update', ['topic' => $sub_topic->slug])}}"
                                                        ><i class="fas fa-pencil-alt mr-1"></i></a>
                                                        <a href="#"
                                                           data-toggle="modal"
                                                           data-target="#deleteRecordModal"
                                                           data-action="{{route('superadmin.topics.destroy', ['topic' => $sub_topic->slug])}}"
                                                        ><i class="fas fa-trash-alt text-danger"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @endforeach
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="4">No records found.</td>
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

    @include('admin.topics.create')
    @include('admin.topics.edit')
    @include('common.delete-record-modal')
@endsection

@push('page-scripts')
    <script>
      $('#editTopic').on('show.bs.modal', function(event) {
        const modal = $('#editTopic');
        const button = $(event.relatedTarget);
        const title = button.data('title');
        const subtitle = button.data('subtitle');
        const description = button.data('description');
        const parent_id = button.data('parent_id');
        const action = button.data('action');
        modal.find('input[name=title]').val(title);
        // modal.find('input[name=subtitle]').val(subtitle);
        modal.find('select[name=parent_id]').val(parent_id);
        modal.find('textarea[name=description]').val(description);
        modal.find('form').attr('action', action);
      });
    </script>
@endpush