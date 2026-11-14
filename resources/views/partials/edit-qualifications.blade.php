<div class="modal fade" id="editQualifications">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Qualifications</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="type" value="qualifications">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Organization Name<span class="text-danger">*</span></label>
                                <input type="text" placeholder="Cambridge Institute" name="title" required value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Degree/Certification <span class="text-danger">*</span></label>
                                <input type="hidden" name="metas[2][meta_key]" value="degree">
                                <input type="text" placeholder="Phd in Computer Science" name="metas[2][meta_value]" required value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="hidden" name="metas[3][meta_key]" value="current_studying">
                                    <input class="form-check-input currently-studying-checkbox" type="checkbox" checked name="metas[3][meta_value]" value="yes" id="currentlyStudyingEdit">
                                    <label class="form-check-label" for="currentlyStudyingEdit">
                                        I am currently Studying Here
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Start Date<span class="text-danger">*</span></label>
                                <input type="hidden" name="metas[0][meta_key]" value="start_date">
                                <input type="month" placeholder="12/12/1993" name="metas[0][meta_value]" required value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group d-none currently-studying-date">
                                <label for="">End Date <span class="text-danger">*</span></label>
                                <input type="hidden" name="metas[1][meta_key]" value="end_date">
                                <input type="month" placeholder="12/12/1993" name="metas[1][meta_value]" value="" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea class="summernote" name="content"></textarea>
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