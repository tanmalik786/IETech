@extends('sales.layout.app')

@push('page-styles')
    <style>
        .section__hero {
            background: rgb(247,246,255);
            background: linear-gradient(356deg, rgba(247,246,255,1) 0%, rgba(225,225,255,1) 50%, rgba(204,242,250,1) 100%);
            padding-top: 3rem;
            padding-bottom: 10rem;
        }

        .section__hero__appui {
            max-width: 450px;
            margin: 0 auto;
        }

        .section__hero__appui img {
            width: 100%;
        }
        h1,h2,p {
            color: #333;
        }

        .software-ui {
            background: rgb(247,246,255);
            background: linear-gradient(356deg, rgba(247,246,255,1) 0%, rgba(225,225,255,1) 50%, rgba(204,242,250,1) 100%);
            padding: 3rem;
            border-radius: 3rem;
        }

        .software-ui img {
            width: 100%;
        }
        .container {
            max-width: 1133px !important;
        }
        .banner--link {
            color: #FFF;
            font-weight: 400;
        }
    </style>
@endpush
@section('content')
    <section class="section">
        <iframe src="{{asset('documents/' . $policy)}}#toolbar=0" width="100%" height="600px" style="border: none;"></iframe>
    </section>
@endsection

@push('page-scripts')
@endpush

