@extends('admin.layout.app')

@section('page-title')
   Pages
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
        <a href="javascript:void(0)"
           data-target="#addPage"
           data-toggle="modal"
           class="btn btn-primary"><i class="fas fa-plus"></i> New Page
        </a>
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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($pages as $key => $page)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$page->title}}</td>
                                        <td>{{$page->status == 0 ? 'Draft' : 'Published'}}</td>
                                        <td>
                                            <a href="#"
                                                data-toggle="modal"
                                                data-target=".editPage"
                                                data-name="{{$page->title}}"
                                                data-slug="{{$page->slug}}"
                                                data-action="{{route('pages.update', ['id' => $page->id])}}"
                                                data-status="{{$page->status}}"
                                                class="btn btn-icon mr-1"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{route('pages.edit', ['page' => $page->slug])}}" class="btn btn-icon">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="javascript:void(0)" data-toggle="modal" data-action="{{route('pages.destroy', ['page' => $page->slug])}}" data-target="#deleteRecordModal" class="btn btn-icon text-danger">
                                                <i class="fas fa-trash-alt"></i>
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
    @include('pages.partials.modals.addPage')
    @include('pages.partials.modals.editPage')
@endsection

@push('page-scripts')
    <script>
        // Delete slide modal
        // Delete Modal
        $('#destroyObservationModal').on('show.bs.modal', function(event) {
            const modalEl = $('#destroyObservationModal');
            const button = $(event.relatedTarget);
            const action = button.data('action');
            modalEl.find('form').attr('action', action);
        });

        $('#comments').on('show.bs.modal', function(event) {
            const modalEl = $('#comments');
            const button = $(event.relatedTarget);
            const action = button.data('action');
            modalEl.find('form').attr('action', action);
        });

        $('.editPage').on('show.bs.modal', function(event) {

            const modalEl = $('.editPage');
            const button = $(event.relatedTarget);
            const action = button.data('action');
            const title = button.data('name');
            const status = button.data('status');

            modalEl.find('form').attr('action', action);
            modalEl.find('#title').val(title)
            modalEl.find('#status').val(status == 1 ? 'published' : 'draft');

        });

    </script>
@endpush