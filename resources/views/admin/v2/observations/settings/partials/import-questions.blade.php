<div class="modal fade" id="importQuestionsModal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="card-title">Import Questions</h3>
            </div>
            <form action="{{route('questions.import')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p class="m-0 py-3">Import questions through CSV file, <a class="#">Click Here</a> to download format.</p>
                    <div class="form-group">
                        <input type="file" name="question_csv" accept="text/csv">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Import</button>
                </div>
            </form>
        </div>

    </div>
</div>