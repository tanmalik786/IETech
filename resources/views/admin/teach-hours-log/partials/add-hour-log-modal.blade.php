<div class="modal fade" id="addHoursLogModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Log</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="updateHourLogForm">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Hours of contact time <span class="text-danger">*</span></label>
                                <input type="text" name="hours_of_contact_time" class="form-control" required>
                            </div>
                        </div>
{{--                        <div class="col-lg-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="">Select Month</label>--}}
{{--                                <select name="month" class="custom-select select-month">--}}
{{--                                    @for($i = 0; $i <= 11; $i++)--}}
{{--                                        <option value="{{$i + 1}}" {{($i + 1) == 12 ? 'selected' : ''}}>{{$months[$i]}}</option>--}}
{{--                                    @endfor--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Week Beginning <span class="text-danger">*</span></label>
                                <input type="text" name="week_beginning" class="form-control datepicker">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="" class="form-control" cols="30" rows="4"></textarea>
                                <p class="note-help-block">Brief description of teaching activity (e.g. subjects, level, student group and setting)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>

    </div>

</div>