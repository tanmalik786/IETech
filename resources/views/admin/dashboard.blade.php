@extends('admin.layout.app')

@section('page-title')
    Dashboard
@endsection

@section('content')
    @if(auth()->user()->hasAnyRole(['Super Admin', 'Institute Admin', 'Mentor', 'Link Tutor']))
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
                            <h3 class="card-title">Teaching Students</h3>
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
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($students as $key => $student)
                                    <tr>
                                        <td>{{$student->full_name}}</td>
                                        <td>
                                            {{$student->privatised_email}}
                                        </td>
                                        <td>
                                            {{$student->created_at->format('d/m/Y')}}
                                        </td>
                                        <td>
                                            @if(session()->has('viewing') && session()->get('viewing')->id == $student->id)
                                            @else
                                            <form action="{{route('impersonate')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="student_id" value="{{$student->id}}" />
                                                <button type="submit" class="btn btn-sm btn-primary">Switch</button>
                                            </form>
                                            @endif
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
    @endif
@endsection