@extends('admin.layout.auth-app')

@section('content')
    <form method="POST" action="{{route('authenticate')}}">
        @csrf
        <img src="{{asset('images/logo.png')}}" style="width:80px;" alt="">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        @if(session()->has('message'))
            {!! session()->get('message'); !!}
        @endif
        <div class="form-floating">
            <input type="email" name="email" required class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
            <span class="invalid-feedback text-left">@error('email') {{$message}} @enderror</span>
        </div>
        <div class="form-floating">
            <input type="password" name="password" required class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
            <span class="invalid-feedback text-left">@error('password') {{$message}} @enderror</span>
        </div>

        <div class="checkbox mb-3 text-left pt-3">
            <label>
                <input type="checkbox" name="remember_me" value="yes"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

        <p class="text-left mt-2">Don't have an account, <a href="{{route('signup')}}" class="fw-bold text-decoration-underline">Register</a></p>
    </form>
@endsection