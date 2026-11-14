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
                                               data-action="{{route('slides.update', ['slide' => $slide->id])}}"
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
                                                data-action="{{route('slides.destroy', ['slide' => $slide->id])}}"
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
                    @endforelse
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('admin.slides.partials.add-slide')
    @include('admin.slides.partials.edit-slide')
    @include('admin.slides.partials.delete-slide')
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