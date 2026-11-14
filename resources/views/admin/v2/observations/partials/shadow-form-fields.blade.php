<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Year Group</label>
            <input type="text" name="year_group" value="{{$observation->year_group ?? ''}}" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Date <span class="text-danger">*</span></label>
            <input type="date" value="{{$observation->date ?? ''}}" name="date" required class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Number of Students</label>
            <input type="text" value="{{$observation->number_of_students ?? ''}}" name="number_of_students" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Ability</label>
            <input type="text" value="{{$observation->ability ?? ''}}" name="ability" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Time</label>
            <input type="time" value="{{$observation->time ?? ''}}" name="time" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Course Title</label>
            <input type="text" value="{{$observation->course_title ?? ''}}" name="course_title" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Learning Topic</label>
            <input type="text" value="{{$observation->topic ?? ''}}" name="topic" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Learning Intentions</label>
            <input type="text" value="{{$observation->outcomes ?? ''}}" name="outcome" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Pre-Req Knowledge</label>
            <input type="text" name="pre_req" value="{{$observation->pre_req ?? ''}}" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Number of Staff</label>
            <input type="text" name="number_of_staff" value="{{$observation->number_of_staff ?? ''}}" class="form-control">
        </div>
    </div>
</div>