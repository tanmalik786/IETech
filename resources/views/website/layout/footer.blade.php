<div class="container">
{{--    <footer class="pt-5">--}}
{{--        <div class="row">--}}
{{--            <div class="col mb-3">--}}
{{--                <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">--}}
{{--                    <img src="{{asset('images/logo.png')}}" class="w-50"  alt="">--}}
{{--                    <h4 class="fw-bold text-dark mx-3">Institute of Emerging Technologies</h4>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="col mb-3"></div>--}}
{{--            <div class="col mb-3"></div>--}}
{{--            <div class="col mb-3"></div>--}}

{{--            <div class="col mb-3">--}}
{{--                <h5 class="text-dark">Institute of Emerging Technologies</h5>--}}
{{--                <ul class="nav flex-column">--}}
{{--                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-dark">Home</a></li>--}}
{{--                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-dark">About</a></li>--}}
{{--                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-dark">Services</a></li>--}}
{{--                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-dark">Blog</a></li>--}}
{{--                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-dark">Forum</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row pt-3">--}}
{{--            <div class="col-lg-10 offset-lg-1">--}}
{{--                <p class="lead text-dark text-center m-0 text-muted"></p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </footer>--}}

    <footer class="d-flex flex-wrap justify-content-between align-items-center pt-3 mt-5 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <img src="{{asset('images/logo.png')}}" style="width: 50px"  alt="">
            </a>
            <span class="mb-3 mb-md-0 text-muted">{{$institute->name}}</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Services</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Blog</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Forum</a></li>
        </ul>

        <div class="mt-3 w-100 pt-5 text-center d-flex align-items-center justify-content-center">
{{--            <p class="m-0 w-75 text-dark text-center" style="font-size:11px;">{{$institute->name}} is an academic project of SUS Consultancy Services (Registration# 12722651, registered for trading in England and Wales), also registered at UKRLP (UK Register for Learning Providers)</p>--}}
        </div>
    </footer>
</div>