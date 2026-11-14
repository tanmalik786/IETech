@extends('admin.layout.app')

@section('page-title')
    Action Plan Items
@endsection

@push('page-styles')
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/summernote/summernote.min.css')}}">
    <style>
        .action__block {
            display: flex;
            flex-direction: row;
            gap: 0.5rem;
        }
        .box {
            border-radius: 50%;
            width: 20px;
            height: 20px;
            aspect-ratio: 1;
            display: block;
        }
        .box-red {
            background: red;
        }
        .box-amber {
            background-color: #FFBF00;
        }
        .box-green {
            background-color: green;
        }
    </style>
@endpush

@section('page-breadcrumb')
    @if(auth()->user()->hasRole('Teaching Student'))
    <div class="text-right">
        <a href="{{route('action-plans.create')}}"
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
                                    <th>Date</th>
                                    <th>Standard Number</th>
{{--                                    <th>Description</th>--}}
{{--                                    <th>Development Points</th>--}}
{{--                                    <th>Actions</th>--}}
{{--                                    <th>Review</th>--}}
                                    <th>RAG Rating</th>
                                    @if( ! auth()->user()->hasRole('Teaching Student'))
                                    <th>Added By</th>
                                    @endif
                                    <th>Last Edited By</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($action_plans as $key => $plan)
                                    <tr>
                                        <td>{{$plan->date->format('d/m/Y')}}</td>
                                        <td>{{$plan->ps}}</td>
{{--                                        <td>{{$plan->date_description}}</td>--}}
{{--                                        <td>{!! \Str::words(trim(strip_tags($plan->development_point)), 5, '...') !!}</td>--}}
{{--                                        <td>{!! \Str::words(trim(strip_tags($plan->actions)), 5, '...') !!}</td>--}}
{{--                                        <td>{!! \Str::words(trim(strip_tags($plan->review)), 5, '...') !!}</td>--}}
                                        <td>{!! $plan->formatted_rating !!}</td>
                                        @if( ! auth()->user()->hasRole('Teaching Student'))
                                        <td>{{$plan->owner->full_name}}</td>
                                        @endif
                                        <td>{{$plan->author->full_name}}</td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               title="view details"
                                               data-toggle="modal"
                                               data-target="#viewActionPlan"
                                               data-actions='{!! str_replace("'", '"', $plan->actions) !!}'
                                               data-review='{!! str_replace("'", '"', $plan->review) !!}'
                                               data-development_point='{!! str_replace("'", '"',$plan->development_point) !!}'
                                               class="mr-1 text-secondary"
                                            >
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if(auth()->user()->hasRole('Teaching Student'))
                                            <a class="mr-1" href="{{route('action-plans.edit', ['action_plan' => $plan->id])}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                               data-toggle="modal"
                                               data-target="#destroyActionPlan"
                                                data-action="{{route('action-plans.destroy', ['action_plan' => $plan->id])}}"
                                            >
                                                <i class="fas fa-trash-alt text-danger"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">No data found</td>
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
    @include('admin.action-plans.view')
    @include('admin.action-plans.destroy')
@endsection

@push('page-scripts')
    <script src="{{asset('vendor/adminlte/plugins/summernote/summernote.min.js')}}"></script>
    <script>

      $('textarea').summernote({
        minHeight: 100
      });

      $('#viewActionPlan').on('show.bs.modal', function(event) {

        const modalEl = $('#viewActionPlan');
        const button = $(event.relatedTarget);
        const action = button.data('actions');
        const review = button.data('review');
        const development_point = button.data('development_point');

        modalEl.find('#action').html( action );
        modalEl.find('#review').html( review );
        modalEl.find('#development_point').html( development_point );

      });

      $('#destroyActionPlan').on('show.bs.modal', function(event) {
        const modalEl = $('#destroyActionPlan');
        const button = $(event.relatedTarget);
        const action = button.data('action');
        modalEl.find('form').attr('action', action);
      });
    </script>
@endpush