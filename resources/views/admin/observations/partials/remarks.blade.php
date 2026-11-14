<div class="modal fade" id="comments" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Comments:</label>
                        <textarea name="remarks" id="" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer align-items-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>

</div>