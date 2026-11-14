@extends('admin.layout.app')

@section('page-title')
    Teaching Hours Log
@endsection

@push('page-styles')

@endpush

@section('page-breadcrumb')
    @if(auth()->user()->hasRole('Teaching Student'))
    <div class="text-right">
        <a href="{{route('hourslog.create')}}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add</a>
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
                                    <th>Name</th>
                                    <th>Academic Year</th>
                                    <th>Total Hours</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($posts as $key => $post)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->content}}</td>
                                        <td>{{$post->teachingLogs()->sum('hours_of_contact_time')}}</td>
                                        <td>{{$post->created_at->format('d F Y')}}</td>
                                        <td>
                                            <a class="mr-1" href="{{route('hourslog.show', ['post' => $post->id])}}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if(auth()->user()->hasRole('Teaching Student'))
                                            <a href="{{route('hourslog.edit', ['post' => $post->id])}}" class="mr-1" >
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)"
                                               data-toggle="modal"
                                               data-target="#deleteRecordModal"
                                               data-action="{{route('hourslog.destroy', ['post' => $post->id])}}"
                                            >
                                                <i class="fas fa-trash-alt text-danger"></i>
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

@endsection

@push('page-scripts')
@endpush