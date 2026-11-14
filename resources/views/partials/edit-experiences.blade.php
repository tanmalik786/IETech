<div class="modal fade" id="editExperiencesModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Experiences</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="type" value="experiences">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Organization Name<span class="text-danger">*</span></label>
                                <input type="text" placeholder="Company Name" name="title" required value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Job Title<span class="text-danger">*</span></label>
                                <input type="hidden" name="metas[2][meta_key]" value="job_title">
                                <input type="text" placeholder="Phd in Computer Science" name="metas[2][meta_value]" required value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mt-5">
                                <div class="form-check">
                                    <input type="hidden" name="metas[3][meta_key]" value="current">
                                    <input class="form-check-input current-checkbox" type="checkbox" checked name="metas[3][meta_value]" value="yes" id="currentEditExperience">
                                    <label class="form-check-label" for="currentEditExperience">
                                        I am currently working here
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
                            <div class="form-group d-none completion-date">
                                <label for="">End Date <span class="text-danger">*</span></label>
                                <input type="hidden" name="metas[1][meta_key]" value="end_date">
                                <input type="month" placeholder="12/12/1993" name="metas[1][meta_value]" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="ProfessionalEdit" value="professional" name="category" checked>
                                <label class="form-check-label" for="ProfessionalEdit">Professional Experience</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="researchEdit" name="category" value="research">
                                <label class="form-check-label" for="researchEdit">Research Experience</label>
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