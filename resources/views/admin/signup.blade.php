@extends('admin.layout.auth-app')

@section('content')
    <form method="POST" action="{{route('register')}}">
        @csrf
        <img src="{{asset('images/logo.png')}}" style="width:80px;" alt="">
        <h1 class="h3 mb-3 fw-normal">Sign Up</h1>
        <div class="form-group">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="subscriber">
                <label class="form-check-label" for="inlineRadio1">Individual</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" checked type="radio" name="type" id="inlineRadio2" value="institute">
                <label class="form-check-label" for="inlineRadio2">Institute</label>
            </div>
        </div>
        <div class="form-floating js-institute">
            <input type="text" name="institute_name" autocomplete="none" class="form-control @error('institute_name') is-invalid @enderror" id="floatingInstName">
            <label for="floatingInstName">Institute Name</label>
            @error('institute_name') <span class="invalid-feedback">{{$message}}</span> @enderror
        </div>
        <div class="form-floating">
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="floatingName" placeholder="John">
            <label for="floatingName">First Name</label>
            @error('first_name') <span class="invalid-feedback">{{$message}}</span> @enderror
        </div>
        <div class="form-floating">
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="floatingName" placeholder="Jhon">
            <label for="floatingName">Last Name</label>
            @error('last_name') <span class="invalid-feedback">{{$message}}</span> @enderror
        </div>
        <div class="form-floating">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
            @error('email') <span class="invalid-feedback">{{$message}}</span> @enderror
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
            @error('password') <span class="invalid-feedback">{{$message}}</span> @enderror
        </div>
        <div class="form-floating">
            <input type="password" name="password_confirmation" class="form-control" id="floatingConfirmPassword">
            <label for="floatingConfirmPassword">Confirm Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
        <p class="mt-5 mb-3 text-muted">Already have an account, <a href="{{route('login')}}" class="fw-bold text-decoration-underline">Login</a></p>
    </form>
@endsection

@push('page-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
      $('input[name=type]').on('change', () => {
        if( $('input[name=type]:checked').val() == 'institute' ) {
          $( '.js-institute' ).show();
        } else {
          $('.js-institute').hide();
        }
      });
    </script>
@endpush