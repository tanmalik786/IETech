@extends('admin.layout.app')

@section('page-title')
    Observations
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
                                    <th>PSET Course and Year</th>
                                    <th>Course/Level</th>
                                    <th>Number of Students</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($observations as $key => $observation)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$observation->mentorObservation->observed->full_name ?? '-'}}</td>
                                        <td>{{$observation->mentorObservation->course_year}}</td>
                                        <td>{{$observation->mentorObservation->observed_course}}</td>
                                        <td>{{$observation->mentorObservation->strength}}</td>
                                        <td>{{$observation->mentorObservation->date->format('d/m/Y')}}</td>
                                        <td>
                                            <a href="{{route('mentor-observation.edit', ['observation' => $observation->id])}}"><i class="fas fa-pencil-alt"></i></a>
                                            <a href=""><i class="fas fa-trash-alt"></i></a>
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

                    </div>

                </div>
            </div>
        </div>
    </section>


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