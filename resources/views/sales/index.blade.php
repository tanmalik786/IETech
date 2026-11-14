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
    <section class="section section__hero">
        <div class="container">
            <div class="col-lg-8 offset-lg-2 text-center">
                <!--<div class="section__hero__appui">-->
                <!--    <img src="{{asset('images/app-ui.png')}}" alt="">-->
                <!--</div>-->
                <h1>Teacher Training</h1>
                <h1><strong>Made easy and Efficient</strong></h1>
                <a href="{{route('register')}}" class="btn btn-outline-primary btn-lg mt-3">Try it for Free Now!</a>
            </div>
        </div>
    </section>
    <section class="section section__about" id="about">
        <div class="container">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h1 class="">Institute of Emerging Technologies</h1>
                <p class="text-center lead">📚 Ignite your passion for teaching, gain expert insights, and become an exceptional educator. Join us in shaping the future of education! </p>
            </div>
        </div>
        <div class="pt-5 pb-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="software-ui">
                        <img src="{{asset('images/Adventure-Learning-model-Doering-2006.png')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <h2>Review, Observation & Feedbacks</h2>
                    <p class="lead">
                        Within the realm of teacher training, mentor reviews serve as a cornerstone. Experienced mentors take on the role of evaluators, providing invaluable guidance and constructive criticism to teaching students. These reviews are not mere assessments but collaborative efforts aimed at refining teaching skills. They act as a compass, directing teacher trainees toward pedagogical excellence and professional growth.
                    </p>
                    <p class="lead">This data-driven approach informs constructive feedback sessions, guiding students toward becoming more effective and confident educators.</p>
                </div>
            </div>
            <div class="pt-5 pb-5"></div>
            <div class="row">
                <div class="col-lg-8">
                    <h2>Reflections & much More</h2>
                    <p class="lead">
                        In our innovative approach, teaching students engage in reflective goal setting based on observations, reviews, and feedback. This process empowers educators to set precise, data-backed Key Performance Indicators (KPIs). These KPIs serve as actionable metrics, enabling educators to make informed decisions, measure progress, and continuously enhance their teaching skills.
                    </p>
                    <p class="lead">
                        Our unique approach empowers teaching students to set reflective goals informed by real data. This personalized goal-setting process ensures educators focus on specific areas of improvement, fostering continuous growth and development in their teaching journey.
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="software-ui">
                        <img src="{{asset('images/observations-reflections-teacher-training.jpeg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="institutes">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1 class="text-center">Institutes</h1>
                    <p class="lead text-center">
                        We are proud to partner with numerous institutes that entrust us with innovating their processes, enabling data-backed decision-making, performance measurement, staff training, and collaborative knowledge sharing. Together, we are shaping a brighter future for education.
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
            @forelse(\App\Models\Institute::all() as $institute)
                <div class="col-lg-4">
                    <a href="{{route('institute', ['institute' => $institute->slug])}}" class="text-dark">
                        <div class="institute">
                            <div class="institute--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-building-check" viewBox="0 0 16 16">
                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514Z"/>
                                    <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6.5a.5.5 0 0 1-1 0V1H3v14h3v-2.5a.5.5 0 0 1 .5-.5H8v4H3a1 1 0 0 1-1-1V1Z"/>
                                    <path d="M4.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z"/>
                                </svg>
                            </div>
                            <h3 class="institute--name text-center">{{$institute->name}}</h3>
                        </div>

                    </a>
                </div>
            @empty
            @endforelse
            </div>
        </div>
    </section>
    <section class="banner">
        <div class="col-lg-12">
            <h3 class="banner--title">Unlock a world of knowledge and opportunities. <a href="{{route('register')}}" class="banner--link">Sign up</a> now and embark on your journey to success!</h3>
        </div>
    </section>
    <section class="py-5" id="contactus" style="background: linear-gradient(356deg, rgba(247, 246, 255, 1) 0%, rgba(225, 225, 255, 1) 50%, rgba(204, 242, 250, 1) 100%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Contact Us</h1>
                    <p class="lead text-center">
                        Have questions or inquiries? Contact us today; we're here to help.
                    </p>
                </div>
            </div>
            <div class="row">
                <!-- Contact Form Column -->
                <div class="col-md-4 offset-lg-4">
                    <form class="text-center">
                        <!-- Form fields go here -->
                        <div class="from-group mb-2">
                            <input type="text" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="from-group mb-2">
                            <input type="email" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="from-group mb-2">
                            <textarea class="form-control" rows="5" placeholder="Your Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-scripts')
@endpush

