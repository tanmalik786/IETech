<div class="modal fade editReflection" id="editReflection">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Reflection</h4>
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
                                <label for="">Title<span class="text-danger">*</span></label>
                                <input type="text" id="title" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Link<span class="text-danger">*</span></label>
                                <input type="text" id="link" name="link" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Comments</label>
                                <textarea name="comments" id="comments" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
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