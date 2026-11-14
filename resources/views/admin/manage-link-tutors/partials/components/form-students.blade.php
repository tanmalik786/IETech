<form action="{{route('manage.link-tutor.students.update', ['user' => $link_tutor->slug])}}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>Selected</th>
                    <th>Teaching Student</th>
                </tr>
                </thead>
                <tbody>
                @forelse($students as $key => $student)
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" {{$student->link_tutor_id === $link_tutor->id ? 'checked' : ''}} name="students[]" type="checkbox" value="{{$student->id}}" id="defaultCheck{{$key}}">
                                <label class="form-check-label" for="defaultCheck{{$key}}">
                                    Selected
                                </label>
                            </div>
                        </td>
                        <td>
                            {{$student->full_name}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No students found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>