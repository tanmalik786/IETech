@extends('admin.layout.app')

@section('page-title')
    Minimum Core
@endsection

@push('page-styles')
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/summernote/summernote.min.css')}}">
    <style>
        .action__block {
            display: flex;
            flex-direction: row;
            gap: 0.5rem;
        }
    </style>
@endpush

@section('page-breadcrumb')
    @if( auth()->user()->hasAnyRole(['Teaching Student']))
    <div class="text-right">
        <a href=""
           data-toggle="modal"
           data-target="#addItem"
           class="btn btn-primary"><i class="fas fa-plus"></i> New Item</a>
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
                                    @unless( auth()->user()->hasRole('Teaching Student') )
                                        <th>Teaching Student</th>
                                    @endunless

                                    <th>Title</th>
                                    <th>Comments</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                    <tbody>
                                    @forelse($cores as $key => $core)
                                        <tr>
                                            @unless( auth()->user()->hasRole('Teaching Student') )
                                                <td>{{$core->user->full_name}}</td>
                                            @endunless
                                            <td>{{$core->title}}</td>
                                            <td>
                                                @if( ! empty( $core->postMetas()->where('meta_key', 'LIKE', 'comments_%')->get() ) )
                                                @foreach( $core->postMetas()->where('meta_key', 'LIKE', 'comments_%')->get() as $meta )
                                                    @if( ! empty($meta->meta_value) )
                                                            {{$meta->meta_value}}
                                                            @php
                                                                $author_id = str_replace('comments_', '', $meta->meta_key);
                                                                $author = \App\Models\User::find($author_id);
                                                                if ( $author ) {
                                                                    echo "by <strong>{$author->full_name}</strong>";
                                                                }
                                                            @endphp
                                                            <br>
                                                    @endif
                                                @endforeach
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{$core->created_at->format('d/m/Y')}}</td>
                                            <td>
                                                @if( auth()->user()->hasAnyRole(['Teaching Student', 'Link Tutor', 'Mentor']) )
                                                <a href="javascript:void(0)"
                                                   title="Add Comments"
                                                   data-toggle="modal"
                                                   data-target="#updateComments"
                                                   data-comments='{{implode(' ', $core->postMetas()->where('meta_key', 'LIKE', 'comments_%')->pluck('meta_value')->toArray() )}}'
                                                   data-action="{{route('minimum-core.update', ['post' => $core->id])}}"
                                                >
                                                    <i class="fas fa-comment-alt"></i>
                                                </a>
                                                @endunless
                                                @if( $core->user_id == auth()->id())
                                                        <input type="hidden" id="description{{$core->id}}" name="description" value='{{$core->content}}'>
                                                        <a href="javascript:void(0)"
                                                           data-toggle="modal"
                                                           data-target="#editItem"
                                                           data-id="{{$core->id}}"
                                                           data-title="{{$core->title}}"
                                                           data-action='{{route('minimum-core.update', ['post' => $core->id])}}'
                                                        >
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                           data-toggle="modal"
                                                           data-target="#deleteRecordModal"
                                                           data-action='{{route('minimum-core.destroy', ['post' => $core->id])}}'
                                                        >
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">No data found</td>
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
    @include('admin.minimum-core.create')
    @include('admin.minimum-core.edit')
    @include('admin.minimum-core.comments')
@endsection

@push('page-scripts')
    <script src="{{asset('vendor/adminlte/plugins/summernote/summernote.min.js')}}"></script>
    <script>

      $('#updateComments').on('show.bs.modal', function(event) {

        const modalEl = $('#updateComments');
        const button = $(event.relatedTarget);
        const action = button.data('action');
        const title = button.data('title');
        const comments = button.data('comments');

        modalEl.find('#title').val( title );
        modalEl.find('#comments').val( comments )

        modalEl.find('form').attr('action', action);

      });


      $('#editItem').on('show.bs.modal', function(event) {

        const modalEl = $('#editItem');
        const button = $(event.relatedTarget);
        const action = button.data('action');
        const title = button.data('title');
        const id = button.data('id');
        const description = $(`#description${id}`).val();

        modalEl.find('#title').val( title );
        $(modalEl).find('.summernote').summernote('code', description);

        modalEl.find('form').attr('action', action);

      });

      $('#destroyObservationModal').on('show.bs.modal', function(event) {
        const modalEl = $('#destroyObservationModal');
        const button = $(event.relatedTarget);
        const action = button.data('action');
        modalEl.find('form').attr('action', action);
      });
      $(document).ready(function() {
        $('.summernote').summernote({
          height: 150,
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['fullscreen', 'codeview']]
          ],
        });
      });
    </script>
@endpush