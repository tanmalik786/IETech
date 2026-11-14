@extends('admin.layout.app')

@section('page-title')
    Shadowing
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
    @if(auth()->user()->hasRole('Teaching Student'))
    <div class="text-right">
        <a href="javascript:void(0)" data-target="#addShadowForm"
           data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>New Shadowing</a>
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
                                    @if( ! auth()->user()->hasRole('Teaching Student'))
                                    <th>Observer</th>
                                    @endif
                                    <th>Observed</th>
                                    <th>Course</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($observations as $key => $observation)
                                    <tr>
                                        <td>{{\Carbon\Carbon::parse($observation->date)->format('d F Y')}}</td>
                                        @if( ! auth()->user()->hasRole('Teaching Student'))
                                        <td>{{$observation->observer->full_name}}</td>
                                        @endif
                                        <td>{{$observation->observed->full_name ?? '-'}}</td>
                                        <td>{{$observation->course_title}}</td>
                                        <td>

                                            <a title="View Shadow Form"
                                               href="{{route('admin.shadow-forms.show', ['shadow_form' => $observation->id])}}"
                                               class="mr-2"><i class="fas fa-eye"></i></a>
                                            @if(auth()->user()->hasRole('Teaching Student'))
                                            <a title="Edit Basic Details"
                                               data-toggle="modal"
                                               data-target="#editShadowForm"
                                                data-id="{{$observation->id}}"
                                               href="javascript:void(0)"
                                               class="mr-2"><i class="fas fa-external-link"></i></a>

                                            <a title="Edit Shadow Form Details" href="{{route('admin.shadow-forms.edit', ['shadow_form' => $observation->id])}}"
                                               class="mr-2">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="#"
                                               data-action="{{route('admin.shadow-forms.destroy', ['shadow_form' => $observation->id])}}"
                                               data-target="#deleteRecordModal"
                                               data-toggle="modal">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            @endif
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


    @include('admin.shadow-form.modal.add')
    @include('admin.shadow-form.modal.edit')
@endsection

@push('page-scripts')

    <script type="text/javascript">
        $('#editShadowForm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var observation_id = button.data('id');
            var modal = $(this);

            $.ajax({
                url: "{{route('ajax.shadow_form')}}?shadow_form_id=" + observation_id,
                method: 'GET',
                success: function (response) {
                  modal.find('form').remove();
                  modal.find('.modal-content').append(response);
                }, error: function (error) {
                    console.log(error);
                }
            });
        });
    </script>
@endpush