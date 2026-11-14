<div class="modal fade" id="addTopic">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Topic</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('superadmin.topics.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" value="{{old('title')}}" required maxlength="50" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <span class="invalid-response">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
{{--                        <div class="col-lg-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="">Subtitle</label>--}}
{{--                                <input type="text" name="subtitle" value="{{old('subtitle')}}" maxlength="50" class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" rows="3" class="form-control">{{old("description")}}</textarea>
                            </div>
                        </div>
                        @if( count($parent_topics) > 0 )
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Parent Topic</label>
                                    <select name="parent_id" id="" class="custom-select">
                                        <option value="" selected>No Parent</option>
                                        @foreach( $parent_topics as $topic)
                                            <option {{old('parent_id') == $topic->id ? 'selected' : ''}} value="{{$topic->id}}">{{$topic->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
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