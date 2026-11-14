@extends('admin.layout.app')

@section('page-title')
    Slides
@endsection

@push('page-styles')
    <style>
        .label-drag-input {
            position: relative;
            width: 100%;
            height: 200px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px dashed #d9d9d9;
            border-radius: 5px;
            cursor: pointer;
            transition: 200ms ease-in;
            background-size: initial;
            background-position: center center;
        }

        .label-drag-input:hover {
            border-color: #0a53be;
            border-radius: 10px;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.3);
        }

        .action-container {
            transition: 300ms ease-in;
        }

        .label-drag-input:hover .action-container {
            scale: 1.2;
        }

        #uploadSlideImage,
        #uploadSlideImageEdit{
            opacity: 0;
            pointer-events: none;
        }


    </style>
@endpush

@section('page-breadcrumb')
    <div class="text-right">
        <a href="#" data-toggle="modal" data-target="#addSlideModal" class="btn btn-primary"><i class="fas fa-plus"></i> Slide</a>
    </div>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if(session()->has('message'))
                        {!! session()->get('message'); !!}
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @forelse($slides as $slide)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <img src="{{asset('storage/slides/' . $slide->name)}}" alt="" class="w-100">
                                    </div>
                                    <div class="col-lg-8">
                                        <h3 class="fw-bold text-dark">{{$slide->title}}</h3>
                                        <p>{{$slide->subtitle}}</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="d-flex flex-row align-items-center">
                                            <a href="#"
                                               data-action="{{route('sliders.slides.update', ['slide' => $slide->id])}}"
                                               data-target="#editSlideModal"
                                               data-toggle="modal"
                                               data-image_url="{{asset('storage/slides/' . $slide->name)}}"
                                               data-id="{{$slide->id}}"
                                               data-title="{{$slide->title}}"
                                               data-subtitle="{{$slide->subtitle}}"
                                               class="mr-2">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="#"
                                               data-action="{{route('sliders.slides.destroy', ['slide' => $slide->id])}}"
                                               data-target="#deleteSlideModal"
                                               data-toggle="modal"
                                            >
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
                                </svg>
                                <p>You don't have any slides, Start by <a href="javascript:void(0)" data-toggle="modal" data-target="#addSlideModal"><i class="fa fa-plus"></i> Add Slide</a></p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('sliders.partials.slides.add-slide')
    @include('sliders.partials.slides.edit-slide')
    @include('sliders.partials.slides.delete-slide')
@endsection

@push('page-scripts')
    <script type="text/javascript">
      const uploadSlideImageContainer = document.getElementById('uploadSlideImageContainer');
      const uploadSlideImageTarget = document.getElementById('uploadSlideImage');
      const actionContainer = document.getElementById('actionContainer');

      uploadSlideImageTarget.onchange = evt => {
        const [file] = uploadSlideImageTarget.files;
        if (file) {
          const imageUrl = URL.createObjectURL(file);
          uploadSlideImageContainer.style.backgroundImage = `url(${imageUrl})`;
        }
        else {
          uploadSlideImageContainer.style.backgroundImage = none;
        }
      };

      // Edit screen
      const uploadSlideImageContainerEdit = document.getElementById('uploadSlideImageContainerEdit');
      const uploadSlideImageTargetEdit = document.getElementById('uploadSlideImageEdit');
      const actionContainerEdit = document.getElementById('actionContainerEdit');

      uploadSlideImageTargetEdit.onchange = evt => {
        const [file] = uploadSlideImageTargetEdit.files;
        if (file) {
          const imageUrl = URL.createObjectURL(file);
          uploadSlideImageContainerEdit.style.backgroundImage = `url(${imageUrl})`;
        }
        else {
          uploadSlideImageContainerEdit.style.backgroundImage = none;
        }
      };



      // edit slide modal
      $('#editSlideModal').on('show.bs.modal', function (event) {

        const modalEl = $('#editSlideModal');
        const button = $(event.relatedTarget);

        const action = button.data('action');

        const title = button.data('title');
        const subtitle = button.data('subtitle');
        const imageUrl = button.data('image_url');


        $(modalEl).find('form').attr('action', action);
        $(modalEl).find('input[name=title]').val(title);
        $(modalEl).find('input[name=subtitle]').val(subtitle);
        $(modalEl).find('#uploadSlideImageContainerEdit').css('backgroundImage', `url(${imageUrl})`);
      });



      // Delete slide modal
      // Delete Modal
      $('#deleteSlideModal').on('show.bs.modal', function(event) {
        const modalEl = $('#deleteSlideModal');
        const button = $(event.relatedTarget);
        const action = button.data('action');
        modalEl.find('form').attr('action',action);
      })
    </script>
@endpush