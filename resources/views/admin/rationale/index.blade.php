@extends('admin.layout.app')

@section('page-title')
    Rationale
@endsection

@push('page-styles')
@endpush

@section('page-breadcrumb')
    @if( auth()->user()->hasAnyRole(['Teaching Student']))
    <div class="text-right">
        <a href="{{route('rationale.create')}}"
           class="btn btn-primary"><i class="fas fa-plus"></i> New Rationale</a>
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
                                    @if( ! auth()->user()->hasRole('Teaching Student') )
                                        <th>Observed</th>
                                    @endif
                                    <th>Course & Year</th>
                                    <th>Observer</th>
                                    <th>Course/ Level</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($rationales as $key => $rat)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        @if( ! auth()->user()->hasRole('Teaching Student') )
                                        <td>{{$rat->observed->full_name ?? $rat->user->full_name}}</td>
                                        @endif
                                        <td>{{$rat->course_year}}</td>
                                        @if( $rat->observer != null)
                                            <td>{{$rat->observer->full_name}} - <strong>{{$rat->observer->roles()->pluck('name')->first()}}</strong></td>
                                        @else
                                            <td>-</td>
                                        @endif

                                        <td>{{$rat->observed_course}}</td>
                                        <td>{{$rat->date ? $rat->date->format('d/m/Y') : '-'}}</td>
                                        <td>
                                            @if( auth()->user()->hasRole('Teaching Student') )
                                                <a href="{{route('rationale.edit', ['rationale' => $rat->id])}}"
                                                   title="Edit Rationale"
                                                   class="mr-2"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#"
                                                   data-action="{{route('rationale.destroy', ['rationale' => $rat->id])}}"
                                                   data-target="#deleteRecordModal"
                                                   data-toggle="modal">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            @elseif( auth()->id() == $rat->observer_id )
                                                <a href="{{route('observations.create', ['rationale' => $rat->id])}}"
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-link"></i>
                                                    Start Observation
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">No data found.</td>
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

      $('#comments').on('show.bs.modal', function(event) {
        const modalEl = $('#comments');
        const button = $(event.relatedTarget);
        const action = button.data('action');
        modalEl.find('form').attr('action', action);
      });
    </script>
@endpush