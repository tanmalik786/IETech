@extends('admin.layout.app')

@section('page-title')
{{__('Edit ') . $page->title}}
@endsection

@section('page-subtitle')
@endsection

@push('page-styles')
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/summernote/summernote.min.css')}}">
    <style>
        #sortable .card > *:not(.card-footer):hover {
            cursor: move;
        }
    </style>
@endpush

@section('page-breadcrumb')
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
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Sections</h3>
                                <a href="javascript:void(0)"
                                   data-toggle="modal"
                                   data-target="#addSection"
                                >
                                    <i class="fas fa-plus"></i>
                                    New Section
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled" id="sortable">
                        @forelse($page->sections()->orderBy('order', 'asc')->get() as $section)
                            <li id="{{$section->order}}" data-section_id="{{$section->id}}">
                                <div class="card">
                                    <div class="card-body">
                                        @switch($section->section_type_id)
                                            @case('1')
                                            Content
                                            @break
                                            @case('2')
                                            Featured Image
                                            @break
                                            @case('3')
                                            {{$section->sectionable->name}} - Slider
                                            @break
                                            @case('4')
                                            {{$section->sectionable->name}} - Carousel
                                            @break
                                            @case('5')
                                            PDF
                                            @break
                                        @endswitch
                                    </div>
                                    <div class="card-footer">
                                        <a href="javascript:void(0)"
                                           data-target="#destroySection"
                                           data-toggle="modal"
                                           data-action="{{route('pages.sections.destroy', ['page' => $page->slug, 'section' => $section->id])}}"
                                        >
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </a>
                                        @if(in_array($section->section_type_id, [1,2,5]))
                                            <a href="javascript:void(0)"
                                               data-target="#viewSection"
                                               data-toggle="modal"
                                               class="ml-2"
                                               data-action="{{route('pages.sections.show', ['page' => $page->slug, 'section' => $section->id])}}"
                                            >
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
                                        <div class="form-group form-check-inline ml-2">
                                            <input type="checkbox" {{$section->status == 1 ? 'checked' : '' }} data-section_id="{{$section->id}}" name="visibility" value="0" class="form-check-input js-section-visibility-toggle" id="sectionVisibility{{$section->id}}">
                                            <label class="form-check-label" for="sectionVisibility{{$section->id}}">Visible</label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @include('pages.partials.modals.addSection')
    @include('pages.partials.modals.destroySection')
    @include('pages.partials.modals.viewSection')
@endsection

@push('page-scripts')
    <script src="{{asset('vendor/adminlte/plugins/summernote/summernote.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">

        $('.js-section-visibility-toggle').on('change', function() {

          const section_id = $( this ).data('section_id');

          $.ajax({
            url: "{{route('ajax.update-section-visibility')}}",
            method: "POST",
            data: {
              _token: '{{csrf_token()}}',
              section_id: section_id,
              status : $( this ).prop('checked') == true ? 1 : 0
            }
          }).done((res) => {
            console.log(res);
          })
        });

        $('textarea').summernote({
            minHeight: 100
        });

        $('select[name=section_type_id]').on('change', function() {

          const section_type_id = $( this ).val();
          $.ajax({
            url: "{{route('ajax.get-section-form')}}",
            method: "POST",
            data: {
              _token: '{{csrf_token()}}',
              section_type_id: section_type_id
            }
          }).done((res) => {
            $("#formWrapper").html(res);
            $('textarea').summernote({
              minHeight: 100
            });
          })
        })

        // Delete Modal
        $('#destroySection').on('show.bs.modal', function(event) {
          const modalEl = $('#destroySection');
          const button = $(event.relatedTarget);
          const action = button.data('action');
          modalEl.find('form').attr('action',action);
        })

        // view section
        $('#viewSection').on('show.bs.modal', function(event) {
          const modalEl = $('#viewSection');
          const button = $(event.relatedTarget);
          const action = button.data('action');

          $.ajax({
            url: action,
            method: "POST",
            data: {
              _token: '{{csrf_token()}}'
            }
          }).done((res) => {
           $(modalEl).find('.modal-body').html( res );
          })

        })

        $( function() {

          $( "#sortable" ).sortable({
            placeholder: "sortable-placeholder",
            opacity: 0.8,
            forcePlaceholderSize: true,
            stop: function( event, ui ) {

              let order = [];

              $(document).
                  find(`#sortable li`).
                  not('.ui-sortable-placeholder').
                  each(function(index, element) {
                    $(element).attr('id', index + 1);

                    let data = {
                      'id': '',
                      'display_order': '',
                    };
                    data.id = $(element).data('section_id');
                    data.display_order = $(element).attr('id');

                    order.push(data);

                  });

              $.ajax({
                url: '{{route("ajax.section.order.update")}}',
                method: 'POST',
                data: {
                  'order': order,
                  '_token': '{{csrf_token()}}',
                },
              }).done((res) => {
                console.log(res);
              });
            }
          });
        } );

    </script>
@endpush