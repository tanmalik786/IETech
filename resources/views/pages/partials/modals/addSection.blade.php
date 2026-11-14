<div class="modal fade" id="addSection">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Section</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form enctype="multipart/form-data" action="{{route('pages.sections.store', ['page' => $page->slug])}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Section Type</label>
                        <select name="section_type_id" id="" class="custom-select">
                            <option value="">{{__('Select Section Type')}}</option>
                            <option value="1">Content</option>
                            <option value="2">Hero Image</option>
                            <option value="3">Slider</option>
                            <option value="4">Carousel</option>
                            <option value="5">Upload PDF</option>
                        </select>
                    </div>
                    <div id="formWrapper"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Section</button>
                </div>
            </form>
        </div>

    </div>

</div>