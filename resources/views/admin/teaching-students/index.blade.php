@extends('admin.layout.app')

@section('page-title')
    Teaching Students
@endsection

@push('page-styles')
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
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($students as $key => $student)
                                    <tr>
                                        <td>{{$key + $students->firstItem()}}</td>
                                        <td>{{$student->full_name}}</td>
                                        <td>
                                            {{$student->privatised_email}}
                                        </td>
                                        <td>
                                            {{$student->created_at->format('d/m/Y')}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No data found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        {!!  $students->links() !!}
                                    </td>
                                </tr>
                                </tfoot>
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