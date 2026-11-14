@extends('website.layout.app')

@push('page-styles')
    <style>
        .section-with-bg {
            background-image: url("{{asset('images/inst-bg.jpg')}}");
            background-position: center center;
            background-size: cover;
            position: relative;
        }

        .section-with-bg .col-lg-6 {
            min-height: 20rem;
            color: #fff;
            letter-spacing: 0.6rem;
        }

        .section-with-bg h3 {
            font-size: 2.5rem;
            z-index: 1;
        }

        .section-with-bg .overlay {
            background-color: rgba(0, 0, 0, 0.7);
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .heading {
            font-size: 1.5rem;
            letter-spacing: 0.33rem;
        }

        .heading-bordered {
            padding-bottom: 0.5rem;
            border-bottom: 3px solid #000;
        }

        a.card {
            transition: 50ms ease-in;
            border-color: transparent;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        a.card:hover {
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
        }

        .card-quote {
            box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.2);
        }

        .row-inverted:first-of-type {
            margin-top: 1rem;
        }

        .row-inverted:not(:last-of-type) {
            margin-bottom: 1rem;
        }

        .card .card-answer {
            padding-left: 1.5rem;
        }

        .card-question {
            font-weight: bold;
            letter-spacing: 0.1rem;
            color: #2d2d2d;
        }

        .card-answer {
            font-size: 1.5rem;
        }

        .calendar {
            margin-top: 0.5rem;
        }

        .calendar p,
        .calendar i {
            font-size: 0.7rem;
            color: #b4b4b4 !important;
        }

        .bordered {
            border-right: 1px solid #d9d9d9 !important;
        }

        .card.card-quote {
            margin-top: 2rem;
        }


        .list-icon-wrapper {
            display: flex;
            width: 100%;
            justify-content: center;
            margin-top: -1.5rem;

        }

        .list-icon {
            position: relative;
            padding: 0;
            display: block;
            margin: 0 auto;
        }

        .list-icon-square {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            padding: 0.33rem 1rem;
            width: auto;
        }

        .list-icon-round {
            border-radius: 100%;
            aspect-ratio: 1;
            width: 50px;
            height: 50px;
        }

        .list-icon-square p.lead {
            margin: 0;
            font-size: 1rem;
        }

        .list-icon-round p.lead {
            font-size: 1rem !important;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        ol {
            display: inline-block;
        }

        .btn-floating {
            position: fixed;
            right: 5%;
            bottom: 5%;
        }
    </style>
@endpush
@section('content')
    @include('website.layout.secondary-navigation')
    <section class="section section-with-bg">
        <div class="container">
            <div class="col-lg-6 offset-lg-3 d-flex justify-content-center align-items-center flex-column">
                <h3 class="text-center">Review - {{$review->stage}}</h3>
                <span class="text-white" style="z-index: 1;">{{$review->created_at->format('d/m/Y')}}</span>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <section class="section bg-dark">
        <div class="container">
            <div class="row mb-0 pt-3 justify-content-center">
                <div class="col-lg-8">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        @foreach($observation_mapping as $key => $step)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{$key == 0 ? 'active' : ''}}" id="pills-{{$step['step']}}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{$step['step']}}" type="button" role="tab" aria-controls="pills-{{$step['step']}}" aria-selected="true">{{$step['display_name']}}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="tab-content" id="pills-tabContent">
                        @php
                            $count = 0;
                        @endphp
                        @foreach($observation_mapping as $key => $step)
                            <div class="tab-pane fade position-relative {{$key == 0 ? 'show active' : ''}}" id="pills-{{$step['step']}}" role="tabpanel" aria-labelledby="pills-{{$step['step']}}-tab">
                                @if($review->details()->where('step', $step['step'])->where('parent_id', null)->count() > 0 )
                                    @foreach($review->details()->where('step', $step['step'])->where('parent_id', null)->get() as $key => $detail)
                                        @if( $detail->response != '')
                                            <div class="d-flex flex-row py-3 w-100">
                                                <div class="card card-quote border-0 w-100" style="position:relative;">
                                                    <div class="list-icon-wrapper">
                                                        <div class="list-icon list-icon-round bg-primary">
                                                            <p class="lead text-white" style="font-size: 3rem;">{{$count + 1}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="text-gray text-center mb-0">{{$detail->activity}}?</p>
                                                        <div class="text-center mt-2 text-dark">
                                                            {!! $detail->response !!}
                                                        </div>
                                                    </div>

                                                    <div class="card-footer">
                                                        @if($detail->subActivity != null)
                                                            @foreach($detail->subActivity as $activity)
                                                                <div class="card-body">
                                                                    <p class="text-gray text-center mb-0">{{$activity->activity}}?</p>
                                                                    <div class="text-center text-dark">
                                                                        {!! $activity->response !!}
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @php
                                            $count = $count + 1;
                                        @endphp
                                    @endforeach
                                @else
                                    <div class="d-flex flex-row py-3 w-100">
                                        <div class="card card-quote border-0 w-100" style="position:relative;">
                                            <div class="list-icon-wrapper">
                                                <div class="list-icon list-icon-square bg-primary">
                                                    <p class="lead text-white" style="font-size: 3rem;">
                                                        <i class="bi bi-folder-x"></i>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-gray text-center mb-0">No Data Found</p>
                                                <div class="text-center mt-2 text-dark">
                                                    {!! $detail->response !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if( \App\Models\ReviewFeedback::where('review_id', $review->id)->where('step', $step['step'])->count() > 0)
                                    <a href="javascript:void(0)" class="btn btn-sm btn-floating btn-outline-primary js-btn-scrollable" data-target="#feedback{{$step['step']}}">Go to Feedback <i class="bi bi-arrow-down-circle-fill"></i></a>
                                    <div class="d-flex flex-row py-3 w-100" id="feedback{{$step['step']}}">
                                        <div class="card card-quote border-0 w-100 bg-dark text-white" style="position:relative;">
                                            <div class="list-icon-wrapper">
                                                <div class="list-icon list-icon-square bg-primary">
                                                    <p class="lead text-white">
                                                        Feedback
                                                    </p>
                                                </div>
                                            </div>

                                            @foreach( \App\Models\ReviewFeedback::where('review_id', $review->id)->where('step', $step['step'])->get() as $ky => $feedback  )
                                                <div class="card-body mb-3 pb-1">
                                                    <div class="text-center mt-2 text-white">
                                                        {!! $feedback->feedback !!}
                                                    </div>
                                                    <div class="text-center mb-3 d-flex flex-column align-items-center" style="color: #d9d9d9 !important">
                                                        <div class="d-inline-flex flex-row align-items-start gap-1">
                                                            <span>Author:  </span><i class="bi bi-person-circle"></i> <span class="text-strong"> {{$feedback->user->full_name}} | {{$feedback->user->roles()->pluck('name')->first()}}</span>
                                                        </div>
                                                        <div class="d-inline-flex flex-row align-items-start gap-1">
                                                            <span>Date:  </span><i class="bi bi-calendar-check"></i> <span class="text-strong"> {{$feedback->created_at->format('d/m/Y')}}</span>
                                                        </div>
                                                    </div>
                                                    <span class="mt-3" style="border-bottom: 1px solid #d9d9d9;width: 180px;display: block;margin: 0 auto"></span>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-scripts')
    <script>
      var buttons = document.querySelectorAll(".js-btn-scrollable");
      console.log(buttons[0].getAttribute('data-target'))
      var currentTarget = document.getElementById(buttons[0].getAttribute('data-target').replace('#', ''));
      var currentButton = buttons[0];

      for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function() {
          this.style.display = 'none';
          var target = this.getAttribute("data-target");
          currentTarget = target;
          currentButton = this;
          document.querySelector(target).scrollIntoView({ behavior: 'smooth' });
        });
      }

      window.onscroll = function() {
        var targetTop = currentTarget.offsetTop;
        var targetBottom = targetTop + currentTarget.offsetHeight;
        var pageTop = window.pageYOffset;
        var pageBottom = pageTop + window.innerHeight;

        if (pageTop > targetTop ) {
          currentButton.style.display = 'none';
        } else {
          currentButton.style.display = 'block';
        }
      };
    </script>
@endpush

