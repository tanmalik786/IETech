<div class="modal fade" id="editSlideModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Slide</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form enctype="multipart/form-data" action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="uploadSlideImageEdit" id="uploadSlideImageContainerEdit" class="label-drag-input d-flex flex-column">
                                <div class="flex-column d-flex align-items-center justify-content-center action-container" id="actionContainerEdit">
                                    <i class="fas fa-image"></i>
                                    <p>Choose Image for Slide</p>
                                </div>
                            </label>
                            <input type="file" name="slide" accept="image/*" id="uploadSlideImageEdit">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Title<span class="text-danger">*</span></label>
                                <input type="text" placeholder="Title for the slide" name="title" required value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Subtitle/Tagline<span class="text-danger">*</span></label>
                                <input type="text" placeholder="Subtitle/tagline for the slide" required name="subtitle" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Slide</button>
                </div>
            </form>
        </div>

    </div>

</div>