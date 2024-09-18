@extends('layouts.app')
@section('content')
<div class="login">
    <div class="container">
        <div class="wrapper">
            <div class="checkout flexwrap">
                <div class="item left styled">
                    <h1 class="text-center">Login</h1>
                     <form action="{{ route('login') }}" method="post">
                        @csrf
                        <p>
                            <label for="email">Email Address <span></span></label>
                            <input type="email" id="email" required autocomplete="off" name="email" class="@error('email') is-invalid @enderror">

                            @if(session('error'))
                               <strong class="text-danger">{{ session('error') }}</strong>
                            @endif
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                        <p>
                            <label for="password">Password <span></span></label>
                            <input type="password" id="password" name="password" required class=" @error('password') is-invalid @enderror" placeholder="Enter The Password" >

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                        <div class="primary-login">
                            <button class="primary-button" type="submit">Login</button>
                        </div>
                        <p class="social__text">Or Sign in with social platforms</p>
                        <div class="flexcol">
                            <div class="socials">
                                <ul class="flexitem">
                                    <li><a href="{{ route('socile.oauth','google') }}"><i class="ri-google-fill"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
