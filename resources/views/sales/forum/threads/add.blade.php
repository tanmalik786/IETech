<div class="modal" id="addThread" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Thread</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('topic.threads.store', ['topic' => $topic->slug])}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Title <span class="text-danger">*</span></label>
                        <input type="text" required name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tags<span class="text-danger">*</span></label>
                        <input type="text" required name="tags" class="form-control">
                        <p class="help-block">Comma separated i.e. (tag 1,tag 2,tag 3)</p>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea cols="30" rows="3" class="form-control" name="content"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Thread</button>
                </div>
            </form>
        </div>
    </div>
</div>