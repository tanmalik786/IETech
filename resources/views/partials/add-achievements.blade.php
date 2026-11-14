<div class="modal fade" id="addAchievements">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Achievement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('profile.detail.store', ['user' => auth()->user()->slug])}}" method="POST">
                @csrf
                <input type="hidden" name="type" value="achievements">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Title<span class="text-danger">*</span></label>
                                <input type="text" placeholder="Your achievement title" name="title" required value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Type<span class="text-danger">*</span></label>
                                <input type="text" placeholder="Type of achievement e.g. Trophy" required name="category" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Completion Date<span class="text-danger">*</span></label>
                                <input type="hidden" name="metas[0][meta_key]" value="end_date">
                                <input type="date" placeholder="12/12/2021" name="metas[0][meta_value]" required value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Duration</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Hours & Minutes</span>
                                    </div>
                                    <input type="hidden" name="metas[1][meta_key]" value="duration_hours">
                                    <input type="text" name="metas[1][meta_value]" placeholder="hours e.g. 48" aria-label="First name" class="form-control">
                                    <input type="hidden" name="metas[2][meta_key]" value="duration_minutes">
                                    <select name="metas[2][meta_value]" id="" class="custom-select">
                                        @for($i = 1; $i <= 59; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
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
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>

    </div>

</div>