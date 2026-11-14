@extends('admin.layout.app')

@section('page-title')
    Continuous Professional Development (CPD)
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
    @if(auth()->user()->hasRole('Teaching Student'))
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
                                    <th style="max-width: 150px">Title</th>
                                    <th>Category</th>
                                    <th>Completed At</th>
                                    <th>Duration</th>
                                    @if( ! auth()->user()->hasRole('Teaching Student'))
                                    <th>Teaching Student</th>
                                    @endif
                                    <th>Create At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                    <tbody>
                                    @forelse($achievements as $key => $achievement)
                                        <tr>
                                            <td style="max-width: 150px;text-wrap: pretty">{{$achievement->title}}</td>
                                            <td>{{$achievement->category}}</td>
                                            <td>
                                                {{\Carbon\Carbon::parse($achievement->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first())->format('d F Y')}}
                                            </td>
                                            <td>
                                                {{$achievement->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first() != null ? "Duration {$achievement->postMetas->where('meta_key', 'duration_hours')->pluck('meta_value')->first()} Hours, " : ""}}
                                                {{$achievement->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first() != null ? "{$achievement->postMetas->where('meta_key', 'duration_minutes')->pluck('meta_value')->first()} minutes" : ""}}
                                            </td>
                                            @if( ! auth()->user()->hasRole('Teaching Student'))
                                                <td>{{$achievement->user->full_name}}</td>
                                            @endif
                                            <td>{{$achievement->created_at->format('d/m/Y')}}</td>

                                            <td>
                                                @if(auth()->user()->hasRole('Teaching Student'))
                                                <a href="javascript:void(0)"
                                                   data-toggle="modal"
                                                   data-target="#editItem"
                                                   data-title="{{$achievement->title}}"
                                                   data-content="{{$achievement->content}}"
                                                   data-category="{{$achievement->category}}"
                                                   @foreach($achievement->postMetas as $key => $post_meta)
                                                   data-meta-{{$post_meta->meta_key}}="{{$post_meta->meta_value}}"
                                                   @endforeach
                                                   data-action="{{route('achievements.update', ['post' => $achievement->id])}}"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                   data-toggle="modal"
                                                   data-target="#deleteRecordModal"
                                                   data-action="{{route('achievements.destroy', ['post' => $achievement->id])}}"
                                                >
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </a>
                                                @endif
                                                    <a href="{{route('achievements.show', ['post' => $achievement->id])}}"
                                                    >
                                                        <i class="fas fa-eye text-info"></i>
                                                    </a>
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
    @include('admin.achievements.create')
    @include('admin.achievements.edit')
@endsection

@push('page-scripts')
    <script src="{{asset('vendor/adminlte/plugins/summernote/summernote.min.js')}}"></script>
    <script>

      // Edit Achievements Modal Shown Event
      $('#editItem').on('show.bs.modal', function (event) {

        const modalEl = $('#editItem');
        const button = $(event.relatedTarget);

        const action = button.data('action');

        const title = button.data('title');
        const category = button.data('category');
        const content = button.data('content');

        const end_date = button.data('meta-end_date');
        const duration_hours = button.data('meta-duration_hours');
        const duration_minutes = button.data('meta-duration_minutes');

        $(modalEl).find('form').attr('action', action);
        $(modalEl).find('input[name=title]').val(title);
        $(modalEl).find('input[name=category]').val(category);
        $(modalEl).find('input[name=metas\\[0\\]\\[meta_value\\]]').val(end_date);
        $(modalEl).find('input[name=metas\\[1\\]\\[meta_value\\]]').val(duration_hours);
        $(modalEl).find('select[name=metas\\[2\\]\\[meta_value\\]]').val(duration_minutes);
        $(modalEl).find('.summernote').summernote('code', content);
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
          ],
        });
      });
    </script>
@endpush