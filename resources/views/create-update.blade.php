@extends('admin.layout.app')

@section('page-title')
    Domains of Practice
@endsection

@section('page-subtitle')
@endsection

@push('page-styles')
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/summernote/summernote.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <style>
        .bs-stepper-header {
            border-bottom: 1px solid #d9d9d9;
        }

        .step:not(:last-of-type) {
            border-right: 2px solid #d9d9d9;
        }

        .step .step-trigger {
            padding: 0.11rem 0.33rem;
            font-size: 0.75rem;
            background: linear-gradient(0deg, rgba(230, 230, 230, 1) 0%, rgba(208, 208, 208, 1) 51%, rgba(159, 159, 159, 1) 100%);
            color: #000;
        }

        .step.active .step-trigger {
            background: linear-gradient(0deg, rgba(0, 123, 255, 1) 0%, rgba(57, 151, 254, 1) 51%, rgba(0, 123, 255, 1) 100%);
            color: #FFF;
        }

        .bs-stepper-content{
            padding: 0;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            flex-direction: row;
            align-items: center;
        }

        .card-footer::after {
            content: '';
            position: absolute;
        }
        .navigation {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .navigation__item {
            display: inline-block;
            font-size: 0.75rem;
        }

        .navigation__link {
            margin: 0;
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
                    <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                        @foreach($observation_mapping as $key => $step)
                            <!-- your steps here -->
                                <div class="step" data-target="#{{$step['step']}}">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="{{$step['step']}}" id="{{$step['step']}}-trigger">
                                        <span class="bs-stepper-label">{{$step['display_name']}}</span>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <div class="bs-stepper-content">
                            <!-- your steps content here -->
                            @foreach($observation_mapping as $key => $step)
                                <div id="{{$step['step']}}" class="content" role="tabpanel" aria-labelledby="{{$step['step']}}-trigger">
                                    <div class="card bg-transparent shadow-none">
                                        @include('admin.reviews.partials.form', ['questions' => $step['questions'], 'step' => $step['step']])
                                        <div class="card-footer">
                                            <div class="button-wrapper">
                                                @if( $key > 0 && count($observation_mapping) > 1 )
                                                    <button class="btn btn-secondary btn-sm" onclick="stepper.previous()">Previous</button>
                                                @endif

                                                @if( ($key + 1) < count($observation_mapping))
                                                    <button class="btn btn-primary btn-sm" onclick="next(this)">Save & Continue</button>
                                                @else
                                                    <button class="btn btn-primary btn-sm" onclick="next(this, 1)">Submit</button>
                                                @endif
                                            </div>

                                            <ul class="navigation">
                                                @foreach($observation_mapping as $key => $step)
                                                    <li class="navigation__item">
                                                        <a href="javascript:void(0)" onclick="navigationTo({{$key + 1}})" class="navigation__link {{$step['step']}} btn btn-sm btn-info">{{$step['step']}} <i class="fas fa-chevron-right"></i></a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('page-scripts')
    <script src="{{asset('vendor/adminlte/plugins/summernote/summernote.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script type="text/javascript">

      $('textarea').summernote({
        minHeight: 100
      });

      var stepper;
      var stepperEl;
      $(document).ready(function() {

        stepperEl = $('.bs-stepper')[0];
        stepper = new Stepper(stepperEl);
        highlightCurrentActiveNavItem();

      });

      const navigationTo = (index) => {
        stepper.to(index);
        highlightCurrentActiveNavItem();
      }

      const next = (el, isLast = 0) => {

        const parent = $(el).closest('.content');
        const step = $(parent).attr('id');
        const form = $(parent).find('form');


        $.ajax({
          url: "{{route('admin.reviews.store')}}",
          method: "POST",
          data: form.serialize() + '&step=' + step,
        }).done((res) => {
          if( res && res.status == 'success') {
            if( isLast == 1 ) {
              window.location.replace('{{route('review-forms')}}')
            }

            $('input[name=review_id]').val( res.review_id );

            stepper.next();
            highlightCurrentActiveNavItem();
          } else {
            alert('Unable to save details, please try again later');
          }
        })
      }


      const highlightCurrentActiveNavItem = () => {
        const currentlyActiveTab = $('.content.active').attr('id');
        $(".navigation__item").find('a').removeClass('active');

        $(`.${currentlyActiveTab}`).addClass('active');
      }

    </script>
@endpush