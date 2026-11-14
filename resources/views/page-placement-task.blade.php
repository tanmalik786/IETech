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
                <h3 class="text-center">Placement Tasks</h3>
                <span class="text-white" style="z-index: 1;">{{$placement_task->created_at->format('d/m/Y')}}</span>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
    <section class="section pt-5">
        <div class="container">
            <div class="col-lg-12">
                <h3 class="text-center mb-3">
                    Planning
                </h3>
                <div class="row text-center">
                    <div class="col-lg-6">
                        <h5>Focus</h5>
                        @foreach($placement_task->plannings()->pluck('focus')->toArray() as $item)
                            {!! $item !!}
                        @endforeach
                    </div>
                    <div class="col-lg-6">
                        <h5>Notes</h5>
                        @foreach($placement_task->plannings()->pluck('notes')->toArray() as $item)
                            {!! $item !!}
                        @endforeach
                    </div>
                </div>
                <h3 class="text-center mt-5">
                    Meeting Student Needs
                </h3>
                <div class="col-lg-12 text-center">
                    {!! $placement_task->student_needs !!}
                </div>
                <h3 class="text-center mt-5 mb-3">
                    Differentiation
                </h3>
                <div class="row text-center">
                    <div class="col-lg-6">
                        <h5>Strategy</h5>
                        @foreach($placement_task->differentials()->pluck('strategy')->toArray() as $item)
                            {!! $item !!}
                        @endforeach
                    </div>
                    <div class="col-lg-6">
                        <h5>Comments</h5>
                        @foreach($placement_task->differentials()->pluck('comments')->toArray() as $item)
                            {!! $item !!}
                        @endforeach
                    </div>
                </div>
                <h3 class="text-center mt-5 mb-3">
                    Embed English, Mathematics, and Digital IT skills
                </h3>
                <div class="row text-center">
                    <div class="col-lg-6">
                        <h5>Key Skill</h5>
                        @foreach($placement_task->stems()->pluck('key_skill')->toArray() as $item)
                            {!! $item !!}
                        @endforeach
                    </div>
                    <div class="col-lg-6">
                        <h5>Plan</h5>
                        @foreach($placement_task->stems()->pluck('plan')->toArray() as $item)
                            {!! $item !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('page-scripts')

@endpush

