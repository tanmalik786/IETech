@extends('admin.layout.app')

@section('page-title')
    Users
@endsection

@push('page-styles')
@endpush

@section('page-breadcrumb')
    <div class="text-right">
        <a href="javascript:void(0)"
           data-target="#addUser"
           data-toggle="modal"
           class="btn btn-primary"><i class="fas fa-plus"></i> New User</a>
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
                                    <th>Full Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
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
                                            @foreach($user->roles as $role)
                                                {{$role->name}}
                                            @endforeach
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td>
                                            {{$user->created_at->format('d/m/Y')}}
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)"
                                               data-target="#editUser"
                                               data-toggle="modal"
                                               data-first_name="{{$user->first_name}}"
                                               data-last_name="{{$user->last_name}}"
                                               data-email="{{$user->email}}"
                                               data-role_id="{{$user->roles()->pluck('id')->first()}}"
                                               data-action="{{route('users.update', ['user' => $user->id])}}"
                                            >
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href=""
                                               data-action=""
                                               data-target="#destroyObservationModal"
                                               data-toggle="modal"
                                            >
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No data found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
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
    @include('admin.users.add')
    @include('admin.users.edit')
@endsection

@push('page-scripts')
    <script>
      $('#editUser').on('show.bs.modal', function(event) {

        const modalEl = $('#editUser');
        const button = $(event.relatedTarget);
        const action = button.data('action');
        const first_name = button.data('first_name');
        const last_name = button.data('last_name');
        const email = button.data('email');
        const role_id = button.data('role_id');

        modalEl.find('form').attr('action', action);
        modalEl.find('#first_name').val(first_name);
        modalEl.find('#last_name').val(last_name);
        modalEl.find('#email').val(email);
        modalEl.find('#role').val(role_id);


      });
      $('#destroyObservationModal').on('show.bs.modal', function(event) {
        const modalEl = $('#destroyObservationModal');
        const button = $(event.relatedTarget);
        const action = button.data('action');
        modalEl.find('form').attr('action', action);
      });
    </script>
@endpush