@extends('admin.layout.app')

@section('page-title')
    Expert Observations
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
    @if( auth()->user()->hasAnyRole(['Teaching Student']) )
        <div class="text-right">
            <a href="{{route('expert.observations.create')}}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>New Expert Observation</a>
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
                                    <th>Sr No.</th>
                                    <th>Teacher Observed</th>
                                    <th>Observer</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($observations as $key => $observation)
                                    <tr>
                                        <td>{{$observations->firstItem() + $loop->index}}</td>
                                        <td>{{$observation->observed->full_name ?? '-'}}</td>
                                        <td>{{$observation->observer->full_name ?? '-'}} - <span class="text-strong">{{$observation->observer->roles[0]->name ?? ''}}</span></td>
                                        <td>{{! empty($observation->date) ? $observation->date->format('d/m/Y') : ''}}</td>
                                        <td>
                                            <a href="{{route('expert.observations.show', ['expert_observation' => $observation->id])}}" class="text-primary"><i class="fas fa-eye mr-2"></i></a>
                                            @if(auth()->user()->hasRole('Teaching Student'))
                                                <a href="{{route('expert.observations.edit', ['expert_observation' => $observation->id])}}" class="text-primary"><i class="fas fa-pencil-alt mr-2"></i></a>
                                                <a href="#"
                                                   class="text-danger"
                                                   data-action="{{route('expert.observations.destroy', ['expert_observation' => $observation->id])}}"
                                                   data-target="#deleteRecordModal"
                                                   data-toggle="modal">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No data found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{--                        <div class="card-footer">--}}
                        {{--                            {{$observations->links()}}--}}
                        {{--                        </div>--}}

                    </div>

                </div>
            </div>
        </div>
    </section>


    @include('admin.v2.observations.partials.destroy')
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