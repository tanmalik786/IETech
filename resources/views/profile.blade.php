@extends('admin.layout.app')

@push('page-styles')
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/summernote/summernote.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
        .list-experience-item {
            display: flex;
            flex-direction: row;
        }
        .list-item-action-buttons {
            flex-grow: 2;
            display: flex;
            align-items: start;
            justify-content: end;
            flex-direction: row;
            padding-right: 1rem;
        }
        .portrait-img {
            width: 100%;
            scale: 1.5;
            object-position: cover;
        }

        .img-wrapper {
            margin: 0 auto;
            width: 80px;
            height: 80px;
            border-radius: 100%;
            overflow: hidden;
            box-shadow: 10px 10px 10px rgb(89 29 114 / 14%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #profileImage {
            opacity: 0;
            pointer-events: none;
        }

        .js-image-change-btn {
            cursor: pointer;
            position: absolute;
            right: 25%;
            top: 22%;
        }

    </style>
@endpush
@section('page-title')
    Profile
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has('message'))
                        {!! session()->get('message'); !!}
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="img-body">
                                <label for="profileImage" class="js-image-change-btn">
                                    <i class="fas fa-pencil-alt"></i>
                                </label>
                                <input type="file" name="profile_image" id="profileImage" accept="image/*">
                                <div class="img-wrapper">
                                    @if(auth()->user()->profileImage != null && auth()->user()->profileImage->file_name)
                                    <img id="imagePreview" class="profile-user-img portrait-img"
                                         src="{{asset('storage/media/' . auth()->user()->profileImage->file_name)}}"
                                         alt="{{auth()->user()->slug}}">
                                    @else
                                        <img id="imagePreview" class="profile-user-img portrait-img"
                                             src="https://via.placeholder.com/150"
                                             alt="User profile picture">
                                    @endif
                                </div>
                            </div>

                            <h3 class="profile-username text-center">{{auth()->user()->first_name . ' ' . auth()->user()->last_name}}</h3>
                            <p class="text-muted text-center">{{auth()->user()->tagline}}</p>
                            <p class="text-center m-0">
                                <a href="#" data-toggle="modal" data-target="#editProfileModal"> <i class="fas fa-pencil-alt"></i>Edit</a>
                            </p>
                            <p class="text-center m-0">
                                <a target="_blank" href="{{route('portfolio.user', ['institute' => auth()->user()->institute->slug,'user' => auth()->user()->slug])}}"> <i class="fas fa-link"></i>
                                    Preview</a>
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#qualifications" data-toggle="tab">Qualifications</a></li>
                                <li class="nav-item"><a class="nav-link" href="#experiences" data-toggle="tab">Experiences</a></li>
                                <li class="nav-item"><a class="nav-link" href="#achievements" data-toggle="tab">Achievements</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="qualifications">
                                    <ul class="list-experience list-unstyled">
                                        <li class="d-flex justify-content-between align-items-center flex-row">
                                            Qualifications
                                            <a href="#" data-toggle="modal" data-target="#addQualificationModal" class="btn btn-primary btn-icon"><i class="bi bi-plus"></i> Add Qualification</a>
                                        </li>
                                        @foreach($qualifications as $qualification)
                                            <li class="list-experience-item list-experience-item-editable mt-3 mb-4 border pl-3 pt-3 pb-3" data-id="">
                                                <i class="bi bi-mortarboard-fill mr-2"></i>
                                                <div class="d-flex flex-column">
                                                    <p class="fw-bold text-dark mb-0"> {{$qualification->postMetas->where('meta_key', 'degree')->pluck('meta_value')->first()}} - {{$qualification->title}}</p>
                                                    <p class="text-muted mb-0">
                                                        {{\Carbon\Carbon::parse($qualification->postMetas->where('meta_key', 'start_date')->pluck('meta_value')->first())->format('F Y')}} -
                                                        @if($qualification->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first() == null || $qualification->postMetas->where('meta_key', 'current_studying')->pluck('meta_value')->first() == 'yes' )
                                                            Present
                                                        @else
                                                            {{\Carbon\Carbon::parse($qualification->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first())->format('F Y')}}
                                                        @endif
                                                    </p>
                                                    @if(!empty($qualification->content))
                                                        {!! $qualification->content !!}
                                                    @endif
                                                </div>
                                                <div class="list-item-action-buttons">
                                                    <a href="#"
                                                       data-toggle="modal"
                                                       data-target="#editQualifications"
                                                       data-id="{{$qualification->id}}"
                                                       data-action="{{route('profile.detail.update', ['institute' => auth()->user()->institute->slug, 'user' => auth()->user()->slug, 'post' => $qualification->id])}}"
                                                       data-title="{{$qualification->title}}"
                                                       @foreach($qualification->postMetas as $key => $post_meta)
                                                       data-meta-{{$post_meta->meta_key}}="{{in_array($post_meta->meta_key, ['start_date', 'end_date']) ? \Carbon\Carbon::parse($post_meta->meta_value)->format('Y-m') : $post_meta->meta_value}}"
                                                       @endforeach
                                                       data-content="{{$qualification->content}}"
                                                       data-category="{{$qualification->category}}"
                                                       title="Edit"
                                                       class="list-experience-item-edit mr-1"
                                                    >
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteRecord" data-action="{{route('profile.detail.destroy', ['post' => $qualification->id])}}" title="Delete" class="list-experience-item-edit"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if(count($qualifications) <= 0)
                                        <div class="d-flex flex-column align-items-center justify-content-center" style="height:200px;">
                                            <i class="fa fa-inbox fa-4x text-muted" aria-hidden="true"></i>
                                            <p class="mt-2 text-muted">Start adding your qualifications</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="experiences">
                                    <ul class="list-experience list-unstyled">
                                        <li class="d-flex justify-content-between align-items-center flex-row">
                                            Experiences
                                            <a href="#" data-toggle="modal" data-target="#addExperiencesModal" class="btn btn-primary btn-icon"><i class="bi bi-plus"></i> Add Experience</a>
                                        </li>
                                        @foreach($experiences as $experience)
                                            <li class="list-experience-item list-experience-item-editable mt-3 mb-4 border pl-3 pt-3 pb-3" data-id="">
                                                <i class="bi bi-briefcase-fill mr-2"></i>
                                                <div class="d-flex flex-column">
                                                    <p class="fw-bold text-dark mb-0"> {{$experience->postMetas->where('meta_key', 'job_title')->pluck('meta_value')->first()}} - {{$experience->title}}</p>
                                                    <p class="text-muted mb-0">
                                                        {{\Carbon\Carbon::parse($experience->postMetas->where('meta_key', 'start_date')->pluck('meta_value')->first())->format('F Y')}} -
                                                        @if($experience->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first() == null || $experience->postMetas->where('meta_key', 'current')->pluck('meta_value')->first() == 'yes')
                                                            Present
                                                        @else
                                                            {{\Carbon\Carbon::parse($experience->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first())->format('F Y')}}
                                                        @endif
                                                    </p>
                                                    @if(!empty($experience->content))
                                                        {!! $experience->content !!}
                                                    @endif
                                                </div>
                                                <div class="list-item-action-buttons">
                                                    <a href="#"
                                                       data-toggle="modal"
                                                       data-target="#editExperiencesModal"
                                                       data-id="{{$experience->id}}"
                                                       data-action="{{route('profile.detail.update', ['user' => auth()->user()->slug, 'post' => $experience->id])}}"
                                                       data-title="{{$experience->title}}"
                                                       @foreach($experience->postMetas as $key => $post_meta)
                                                            data-meta-{{$post_meta->meta_key}}="{{in_array($post_meta->meta_key, ['start_date', 'end_date']) ? \Carbon\Carbon::parse($post_meta->meta_value)->format('Y-m') : $post_meta->meta_value}}"
                                                       @endforeach
                                                       data-content="{{$experience->content}}"
                                                       data-category="{{$experience->category}}"
                                                       title="Edit"
                                                       class="list-experience-item-edit mr-1"
                                                    >
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteRecord" data-action="{{route('profile.detail.destroy', ['post' => $experience->id])}}" title="Delete" class="list-experience-item-edit"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if(count($experiences) <= 0)
                                        <div class="d-flex flex-column align-items-center justify-content-center" style="height:200px;">
                                            <i class="fa fa-inbox fa-4x text-muted" aria-hidden="true"></i>
                                            <p class="mt-2 text-muted">Start adding your experiences</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="achievements">
                                    <ul class="list-experience list-unstyled">
                                        <li class="d-flex justify-content-between align-items-center flex-row">
                                            Achievements
                                            <a href="#" data-toggle="modal" data-target="#addAchievements" class="btn btn-primary btn-icon"><i class="bi bi-plus"></i> Add Achievement</a>
                                        </li>
                                        @foreach($achievements as $achievement)
                                            <li class="list-experience-item list-experience-item-editable mt-3 mb-4 border pl-3 pt-3 pb-3" data-id="">
                                                <i class="bi bi-mortarboard-fill mr-2"></i>
                                                <div class="d-flex flex-column">
                                                    <p class="fw-bold text-dark mb-0">{{$achievement->title}} | {{$achievement->category}}</p>
                                                    <p class="text-muted mb-0">
                                                        {{\Carbon\Carbon::parse($achievement->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first())->format('d F Y')}} |
                                                        {{$achievement->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first() != null ? "Duration {$achievement->postMetas->where('meta_key', 'duration_hours')->pluck('meta_value')->first()} Hours, " : ""}}
                                                        {{$achievement->postMetas->where('meta_key', 'end_date')->pluck('meta_value')->first() != null ? "{$achievement->postMetas->where('meta_key', 'duration_minutes')->pluck('meta_value')->first()} minutes" : ""}}
                                                    </p>
                                                    @if(!empty($achievement->content))
                                                        {!! $achievement->content !!}
                                                    @endif
                                                </div>
                                                <div class="list-item-action-buttons">
                                                    <a href="#"
                                                       data-toggle="modal"
                                                       data-target="#editAchievements"
                                                       data-id="{{$achievement->id}}"
                                                       data-action="{{route('profile.detail.update', ['user' => auth()->user()->slug, 'post' => $achievement->id])}}"
                                                       data-title="{{$achievement->title}}"
                                                       @foreach($achievement->postMetas as $key => $post_meta)
                                                       data-meta-{{$post_meta->meta_key}}="{{$post_meta->meta_value}}"
                                                       @endforeach
                                                       data-content="{{$achievement->content}}"
                                                       data-category="{{$achievement->category}}"
                                                       title="Edit"
                                                       class="list-experience-item-edit mr-1"
                                                    >
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteRecord" data-action="{{route('profile.detail.destroy', ['post' => $achievement->id])}}" title="Delete" class="list-experience-item-edit"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if(count($achievements) <= 0)
                                        <div class="d-flex flex-column align-items-center justify-content-center" style="height:200px;">
                                            <i class="fa fa-inbox fa-4x text-muted" aria-hidden="true"></i>
                                            <p class="mt-2 text-muted">Start adding your achievements</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    @include('admin.partials.profile-edit-basic-details')
    @include('admin.partials.add-qualifications')
    @include('admin.partials.edit-qualifications')
    @include('admin.partials.add-experiences')
    @include('admin.partials.edit-experiences')
    @include('admin.partials.add-achievements')
    @include('admin.partials.edit-achievements')
    @include('admin.partials.destroy')
@endsection

@push('page-scripts')
    <script src="{{asset('vendor/adminlte/plugins/summernote/summernote.min.js')}}"></script>
    <script>
      const imgInput = document.getElementById('profileImage');
      const imgPreview = document.getElementById('imagePreview');
      imgInput.onchange = evt => {
        const [file] = imgInput.files
        const saveableFile = file;
        if (file) {
          imgPreview.src = URL.createObjectURL(file);
          changeProfileImage(saveableFile);
        }
      }

      const changeProfileImage = (file) => {
        
        const formData = new FormData();
        formData.append('profile_image', file);
        formData.append('_token', '{{csrf_token()}}');

        $.ajax({
          type:'POST',
          url: "{{route('ajax.updateProfileImage', ['user' => auth()->user()->slug])}}",
          data:formData,
          cache:false,
          contentType: false,
          processData: false,
          success:function(data){
            console.log("success");
          },
          error: function(data){
            console.log("error");
          }
        });

      }

      // Edit Achievements Modal Shown Event
      $('#editAchievements').on('show.bs.modal', function (event) {

        const modalEl = $('#editAchievements');
        const button = $(event.relatedTarget);

        const action = button.data('action');

        const title = button.data('title');
        const category = button.data('category');
        const content = button.data('content');

        const end_date = button.data('meta-end_date');
        const duration_hours = button.data('meta-duration_hours');
        const duration_minutes = button.data('meta-duration_minutes');

        $(modalEl).find('form').attr('action', action);
        $(modalEl).find('input[name=title]').val(title);
        $(modalEl).find('input[name=category]').val(category);
        $(modalEl).find('input[name=metas\\[0\\]\\[meta_value\\]]').val(end_date);
        $(modalEl).find('input[name=metas\\[1\\]\\[meta_value\\]]').val(duration_hours);
        $(modalEl).find('select[name=metas\\[2\\]\\[meta_value\\]]').val(duration_minutes);
        $(modalEl).find('.summernote').summernote('code', content);
      });

      // Edit Qualification Modal Shown Event
      $('#editQualifications').on('show.bs.modal', function (event) {

        const modalEl = $('#editQualifications');
        const button = $(event.relatedTarget);

        const action = button.data('action');

        const title = button.data('title');
        const content = button.data('content');

        const degree = button.data('meta-degree'); // job title
        const start_date = button.data('meta-start_date'); // job title
        const end_date = button.data('meta-end_date'); // current
        const current = button.data('meta-current_studying'); // end date

        $(modalEl).find('form').attr('action', action);
        $(modalEl).find('input[name=title]').val(title);
        $(modalEl).find('input[name=metas\\[0\\]\\[meta_value\\]]').val(start_date); // start date
        $(modalEl).find('input[name=metas\\[1\\]\\[meta_value\\]]').val(end_date); // end date
        $(modalEl).find('input[name=metas\\[2\\]\\[meta_value\\]]').val(degree); // degree
        $(modalEl).find('.currently-studying-checkbox').prop('checked', current === 'yes');
        $(modalEl).find('.currently-studying-checkbox').trigger('change')
        $(modalEl).find('.summernote').summernote('code', content);
      });

      // Edit Experiences Modal Shown Event
      $('#editExperiencesModal').on('show.bs.modal', function (event) {

        const modalEl = $('#editExperiencesModal');
        const button = $(event.relatedTarget);

        const action = button.data('action');

        const title = button.data('title');
        const content = button.data('content');
        const category = button.data('category');

        const job_title = button.data('meta-job_title'); // job title
        const start_date = button.data('meta-start_date'); // job title
        const end_date = button.data('meta-end_date'); // current
        const current = button.data('meta-current'); // end date

        $(modalEl).find('form').attr('action', action);

        $(modalEl).find('input[name=title]').val(title);
        $(modalEl).find('input[name=metas\\[0\\]\\[meta_value\\]]').val(start_date); // start date
        $(modalEl).find('input[name=metas\\[1\\]\\[meta_value\\]]').val(end_date); // end date
        $(modalEl).find('input[name=metas\\[2\\]\\[meta_value\\]]').val(job_title); // job title
        $(modalEl).find('.current-checkbox').prop('checked', current === 'yes');

        $(modalEl).find(`input[type=radio][value=${category}]`).prop('checked', true);
        $(modalEl).find('.current-checkbox').trigger('change')
        $(modalEl).find('.summernote').summernote('code', content);

      });

      // Delete Modal
      $('#deleteRecord').on('show.bs.modal', function(event) {
        const modalEl = $('#deleteRecord');
        const button = $(event.relatedTarget);
        const action = button.data('action');

        modalEl.find('form').attr('action',action);
      })

      $('.current-checkbox').on('change', function() {

        const parentEl = $(this).closest('.modal-body');
        if( $(this).prop('checked') == true ) {
            $(parentEl).find(".completion-date").addClass('d-none');
            // $(this).closest('.form-group').removeClass('d-none');
        } else {
          $(parentEl).find('.completion-date').removeClass('d-none');
          // $(this).closest('.form-group').addClass('d-none');
        }
      })

      $('.currently-studying-checkbox').on('change', function() {

        const parentEl = $(this).closest('.modal-body');
        if( $(this).prop('checked') == true ) {
          $(parentEl).find(".currently-studying-date").addClass('d-none');
          // $(this).closest('.form-group').removeClass('d-none');
        } else {
          $(parentEl).find('.currently-studying-date').removeClass('d-none');
          // $(this).closest('.form-group').addClass('d-none');
        }
      })

      $(document).ready(function() {
        $('.summernote').summernote({
          height: 150,
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
          ],
        });
      });
    </script>
@endpush