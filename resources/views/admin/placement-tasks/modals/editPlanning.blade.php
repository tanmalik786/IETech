<div class="modal fade" id="editPlanning">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Planning Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" class="update-placement-tasks-form">
                <input type="hidden" name="id">
                <input type="hidden" name="type" value="planning">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Focus <span class="text-danger">*</span></label>
                                <textarea name="focus" id="" cols="30" rows="10" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Notes <span class="text-danger">*</span></label>
                                <textarea name="notes" id="" cols="30" rows="10" class="summernote"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>

    </div>

</div>