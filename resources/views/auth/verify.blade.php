@extends('admin.layout.auth-app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Verify Your Email Address') }}</div>
        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-block btn-primary">{{ __('click here to request another') }}</button>.
            </form>
            <form action="{{route('logout')}}" class="d-block">
                <button type="submit" class="btn btn-block mt-2 btn-outline-danger ">{{ __('Logout') }}</button>
            </form>
        </div>
    </div>
@endsection
