<div class="modal fade" id="newPlan">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Action Plan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('action-plans.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Date<span class="text-danger">*</span></label>
                                <input type="date" required id="date" name="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Date Description <span class="text-danger">*</span></label>
                                <input type="text" required id="date_description" name="date_description" class="form-control">
                                <p class="help-block">Description for date e.g. 15/11/2022
                                    PSET Observation (Katya & Samir)
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">RAG Rating <span class="text-danger">*</span></label>
                                <select name="rating" id="rating" class="custom-select" >
                                    <option value="">{{__('Select RAG Rating')}}</option>
                                    <option value="red">Red</option>
                                    <option value="amber">Amber</option>
                                    <option value="green">Green</option>
                                </select>
                            </div>
                        </div>
                        @if( auth()->user()->hasAnyRole(['Link Tutor', 'Mentor']))
                            <div class="col-lg-4">
                                <label for="">Select User <span class="text-danger">*</span></label>
                                <select name="user_id" id="user_id" class="custom-select">
                                    @foreach(\App\Models\User::whereHas('roles', function($q){$q->where('name', 'Teaching Student');})->get() as $user)
                                    <option value="{{$user->id}}">{{$user->full_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Development Point<span class="text-danger">*</span></label>
                                <textarea name="development_point" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Actions<span class="text-danger">*</span></label>
                                <textarea name="actions" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Review</label>
                                <textarea name="review" class="summernote"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Action Plan</button>
                </div>
            </form>
        </div>

    </div>

</div>