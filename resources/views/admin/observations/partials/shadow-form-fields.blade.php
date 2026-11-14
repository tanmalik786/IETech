<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Shadowing <span class="text-danger">*</span></label>

            <select required name="observed_id" id="" class="custom-select">
                <option value="">{{__('Select User')}}</option>
                @foreach($users as $user)
                    <option {{isset($shadow_form) && $shadow_form->observed_id == $user->id ? 'selected' : ''}}  value="{{$user->id}}">{{$user->full_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Year Group</label>
            <input type="text" name="year_group" value="{{$shadow_form->year_group ?? ''}}" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Date <span class="text-danger">*</span></label>
            <input type="date" value="{{$shadow_form->date ?? ''}}" name="date" required class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Number of Students</label>
            <input type="text" value="{{$shadow_form->number_of_students ?? ''}}" name="number_of_students" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Ability</label>
            <input type="text" value="{{$shadow_form->ability ?? ''}}" name="ability" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Time</label>
            <input type="time" value="{{$shadow_form->time ?? ''}}" name="time" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Course Title</label>
            <input type="text" value="{{$shadow_form->course_title ?? ''}}" name="course_title" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Learning Topic</label>
            <input type="text" value="{{$shadow_form->topic ?? ''}}" name="topic" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Learning Intentions</label>
            <input type="text" value="{{$shadow_form->outcome ?? ''}}" name="outcome" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Pre-Req Knowledge</label>
            <input type="text" name="pre_req" value="{{$shadow_form->pre_req ?? ''}}" class="form-control">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Number of Staff</label>
            <input type="text" name="number_of_staff" value="{{$shadow_form->number_of_staff ?? ''}}" class="form-control">
        </div>
    </div>
</div>