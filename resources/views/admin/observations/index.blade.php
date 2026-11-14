@extends('admin.layout.app')

@section('page-title')
    @if($observation_type->name == 'shadow' )
        Shadow Form
    @elseif($observation_type->name == 'general')
        PSET Observation
    @else
        {{ucfirst($observation_type->name) . ' Observation'}}
    @endif
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
           data-target="#addObservation"
           data-toggle="modal"
           class="btn btn-primary"><i class="fas fa-plus"></i> {{$observation_type->name == 'general' ? 'Observation' : ucfirst($observation_type->name) . ' Observation'}}</a>
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
                                    <th>Date</th>
                                    <th>{{$observation_type->name == 'expert' ? 'Name of Observer' : 'Course' }}</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($observations as $key => $observation)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{\Carbon\Carbon::parse($observation->date)->format('d F Y')}}</td>
                                        <td>{{$observation_type->name == 'expert' ? $observation->teacher_observed : $observation->course_title}}</td>
                                        <td>
                                            <a title="View Activities" href="{{route('observations.show', ['observation_type' => $observation_type->slug, 'observation' => $observation->id])}}" class="mr-2"><i class="fas fa-eye"></i></a>
                                            <a href="javascript:void(0)"
                                               data-target="#editObservation"
                                               data-toggle="modal"
                                               data-action="{{route('observations.edit', ['observation' => $observation->id, 'observation_type' => $observation_type->slug])}}"
                                               class="mr-2"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="#"
                                               data-action="{{route('observations.destroy', ['observation' => $observation->id, 'observation_type' => $observation_type->slug])}}"
                                               data-target="#destroyObservationModal"
                                               data-toggle="modal">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>

                                            @if($observation_type->slug == 'shadow')
                                                <a href="#"
                                                    class="ml-2"
                                                    data-action="{{route('observations.remarks.store', ['observation' => $observation->id])}}"
                                                    data-target="#comments"
                                                    data-toggle="modal"
                                                >
                                                    <i class="fa fa-comments" aria-hidden="true"></i>
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

    @include('admin.observations.partials.remarks')
    @include('admin.observations.create')
    @include('admin.observations.edit')
    @include('admin.observations.partials.destroy')
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

      $('#editObservation').on('show.bs.modal', function(event) {
        const modalEl = $('#editObservation');
        const button = $(event.relatedTarget);
        const action = button.data('action');
        modalEl.find('form').attr('action', action);

        $.ajax({
          url: action,
          method: 'GET'
        }).done((res) => {
            modalEl.find('form').remove();
            modalEl.find('.modal-content').append(res);
        })

      });
    </script>
@endpush