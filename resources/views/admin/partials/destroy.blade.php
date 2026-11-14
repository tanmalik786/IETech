<div class="modal fade" id="deleteRecord" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <h3 class="py-3">Are you sure, You want to delete this record?</h3>
                </div>
                <div class="modal-footer align-items-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>

    </div>

</div>