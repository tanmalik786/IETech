<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Trainee teacher observed</label>
            <input type="text" name="teacher_observed" value="{{$observation->teacher_observed ?? ''}}" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">PSET course and year</label>
            <input type="text" name="year_group" value="{{$observation->year_group ?? ''}}" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Date <span class="text-danger">*</span></label>
            <input type="date" name="date" value="{{$observation->date ?? ''}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Observed course/ level</label>
            <input type="text" name="course_title" value="{{$observation->course_title ?? ''}}" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Number of Learners</label>
            <input type="text" name="number_of_students" value="{{$observation->number_of_students ?? ''}}" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Organization</label>
            <input type="text" name="organization" value="{{$observation->organization ?? ''}}" class="form-control">
        </div>
    </div>
</div>