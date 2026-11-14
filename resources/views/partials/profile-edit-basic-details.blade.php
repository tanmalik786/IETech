<div class="modal fade" id="editProfileModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Basic Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('profile.update', ['user' => auth()->user()->slug])}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" required value="{{auth()->user()->first_name}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="last_name" required value="{{auth()->user()->last_name}}" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="">Tagline</label>
                    <input type="text" name="tagline" placeholder="Software Engineer" value="{{auth()->user()->tagline}}" class="form-control">
                </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>

    </div>

</div>