@extends('admin.layout.app')

@section('page-title')
    Link Tutors
@endsection

@push('page-styles')
@endpush

@section('page-breadcrumb')
{{--    <div class="text-right">--}}
{{--        <a href="javascript:void(0)"--}}
{{--           data-target="#addUser"--}}
{{--           data-toggle="modal"--}}
{{--           class="btn btn-primary"><i class="fas fa-plus"></i> New User</a>--}}
{{--    </div>--}}
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
                                    <th>Mentors</th>
                                    <th>Students</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $key => $user)
                                    <tr>
                                        <td>{{$key + $users->firstItem()}}</td>
                                        <td>{{$user->full_name}}</td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td>
                                            {{$user->mentors->count()}}
                                        </td>
                                        <td>
                                            {{$user->linkTutorStudents()->count()}}
                                        </td>
                                        <td>
                                            {{$user->created_at->format('d/m/Y')}}
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               title="Manage Mentors"
                                               data-target="#manageMentors"
                                               data-toggle="modal"
                                               data-id="{{$user->id}}"
                                            >
                                                <i class="fas fa-pencil-alt mr-1"></i>
                                                Manage Mentors
                                            </a>
                                            <a href="javascript:void(0)"
                                               title="Manage Students"
                                               data-target="#manageStudents"
                                               data-toggle="modal"
                                               data-id="{{$user->id}}"
                                            >
                                                <i class="fas fa-pencil-alt mr-1"></i>
                                                Manage Students
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No data found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="7">
                                        {!!  $users->links() !!}
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
    @include('admin.manage-link-tutors.partials.manage-mentors')
    @include('admin.manage-link-tutors.partials.manage-students')
@endsection

@push('page-scripts')
    <script>
      $('#manageMentors').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget)
        const link_tutor_id = button.data('id')
        const modal = $(this);

        $.ajax({
          url: '{{url('ajax/manage/link-tutors/mentors')}}',
          method: 'POST',
          data: {
            "_token": "{{ csrf_token() }}",
            "link_tutor_id":link_tutor_id,
          }
        }).done(res => {
            modal.find('.modal-content form').remove();
            modal.find('.modal-content').append(res);
        });


      });
    </script>
    <script>
      $('#manageStudents').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget)
        const link_tutor_id = button.data('id')
        const modal = $(this);

        $.ajax({
          url: '{{url('ajax/manage/link-tutor/students')}}',
          method: 'POST',
          data: {
            "_token": "{{ csrf_token() }}",
            "link_tutor_id":link_tutor_id,
          }
        }).done(res => {
          modal.find('.modal-content form').remove();
          modal.find('.modal-content').append(res);
        });


      });
    </script>
@endpush