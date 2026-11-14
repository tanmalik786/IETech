<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Name of Observer</label>
            <input type="text" name="teacher_observed" value="{{$observation->teacher_observed ?? auth()->user()->full_name}}" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Observee</label>
            <input type="text" name="year_group" value="{{$observation->year_group ?? ''}}" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Date <span class="text-danger">*</span></label>
            <input type="date" value="{{$observation->date ?? ''}}" name="date" required class="form-control">
        </div>
    </div>
</div>