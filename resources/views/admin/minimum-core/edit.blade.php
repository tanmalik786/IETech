<div class="modal fade" id="editItem">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="type" value="achievements">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Title<span class="text-danger">*</span></label>
                                <input type="text" id="title" placeholder="Skills/Knowledge" name="title" required value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Description <span class="text-danger">*</span></label>
                                <textarea id="description" class="summernote" required name="content"></textarea>
                                <p class="help-block">describe skill/knowledge</p>
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