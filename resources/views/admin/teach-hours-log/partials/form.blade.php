<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            Hours Log
        </h3>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-lg-12">
                <p class="text-dark d-inline-block border-bottom border-dark pb-2"><strong>Basic Details</strong></p>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$post->title ?? auth()->user()->full_name}}" required>
                    @error('title')
                    <span class="invalid-feedback">
                        {{$message}}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Academic Year <span class="text-danger">*</span></label>
                    <select name="content" required id="" class="custom-select @error('content') is-invalid @enderror">
                        @foreach(['2022-2023','2023-2024', '2024-2025', '2025-2026'] as $year)
                            <option value="{{$year}}" {{$year == '2022-2023' || (isset($post) && $post->content == $year) ? 'selected' : ''}}>{{$year}}</option>
                        @endforeach
                    </select>
                    @error('content')
                    <span class="invalid-feedback">
                        {{__('Academic Year is required')}}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Total Hours</label>
                    <input type="text" value="0" readonly disabled class="form-control totalHours">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="text-dark d-inline-block border-bottom border-dark pb-2"><strong>Hours</strong></p>
                    <a href="#" data-toggle="modal" data-target="#addHoursLogModal" class="btn btn-primary btn-sm"> <i class="fas fa-plus-circle mr-1"></i> Add</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-wrapper">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Sr No</th>
                            <th>Week Beginning</th>
                            <th>Brief description of teaching activity (e.g. subjects, level, student group and setting)</th>
                            <th>Hours of contact time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($post) && $post->teachingLogs)
                            @foreach($post->teachingLogs as $key => $log)
                                <tr>
                                    <input type="hidden" name="logs[{{$key}}][week_beginning]" value="{{$log->week_beginning}}">
                                    <input type="hidden" name="logs[{{$key}}][description]" value="{{$log->description}}">
                                    <input type="hidden" name="logs[{{$key}}][hours_of_contact_time]" value="{{$log->hours_of_contact_time}}">
                                    <td>{{$key + 1}}</td>
                                    <td>{{$log->week_beginning}}</td>
                                    <td>{{$log->description}}</td>
                                    <td>{{$log->hours_of_contact_time}}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="editLog({{$key}})"><i class="fas fa-pencil-alt text-dark mr-1"></i></a>
                                        <a href="javascript:void(0)" onclick="removeLog({{$key}})"><i class="fas fa-trash-alt text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="5">No hours logged.</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{URL::Previous()}}"  class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary btn-form--submit">{{isset($post) ? 'Update' : 'Save'}}</button>
    </div>
</div>