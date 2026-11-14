@extends('admin.layout.app')

@section('page-title')
    Reviews
@endsection

@push('page-styles')
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
        <a href="{{route('review-forms.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> New Review</a>
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
                                    <th>Date</th>
                                    <th>Stage</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                    <tbody>
                                    @forelse($reviews as $key => $review)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$review->created_at->format('d F, Y')}}</td>
                                            <td>{{ucfirst($review->stage)}}</td>
                                            <td>
                                                @if( auth()->user()->hasRole('Teaching Student'))
                                                <div class="action__block">
                                                    <a href="{{route('admin.reviews.edit', ['id' => $review->id])}}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href=""
                                                       data-action="{{route('admin.reviews.destroy', ['id' => $review->id])}}"
                                                       data-target="#destroyObservationModal"
                                                       data-toggle="modal"
                                                    >
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                    @if( $review->stage != 'exit')
                                                    <a title="Clone this Review to next stage" href="{{route('admin.reviews.clone', ['id' => $review->id])}}">
                                                        <i class="fas fa-copy"></i>
                                                    </a>
                                                    @endif
                                                </div>
                                                @elseif ( auth()->user()->hasAnyRole(['Mentor', 'Link Tutor'])  )
                                                    <a href="{{route('admin.review-feedback.create', ['review' => $review->id])}}" class="btn btn-primary btn-sm">Write Feedback</a>
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
    @include('admin.reviews.partials.destroy')
@endsection

@push('page-scripts')
    <script>
      $('#destroyObservationModal').on('show.bs.modal', function(event) {
        const modalEl = $('#destroyObservationModal');
        const button = $(event.relatedTarget);
        const action = button.data('action');
        modalEl.find('form').attr('action', action);
      });
    </script>
@endpush