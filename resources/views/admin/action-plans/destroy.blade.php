<div class="modal fade" id="destroyActionPlan" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <h3 class="py-3">Are you sure, You want to delete this action plan?</h3>
                    <p class="lead m-0">Everything related to this plan will be deleted</p>
                </div>
                <div class="modal-footer align-items-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>

    </div>

</div>