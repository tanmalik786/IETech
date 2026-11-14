<div class="modal fade" id="editUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">First Name<span class="text-danger">*</span></label>
                                <input type="text" required id="first_name" name="first_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Last Name<span class="text-danger">*</span></label>
                                <input type="text" required id="last_name" name="last_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Email<span class="text-danger">*</span></label>
                                <input type="text" required id="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Role <span class="text-danger">*</span></label>
                                <select name="role" required id="role" class="custom-select">
                                    <option value="">{{__('Select Role')}}</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>

    </div>

</div>