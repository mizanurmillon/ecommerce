@extends('layouts.app')

@section('content')
<div class="login">
    <div class="container">
        <div class="wrapper">
            <div class="checkout flexwrap">
                <div class="item left styled">
                    <h1 class="text-center">Sing Up</h1>
                   <form action="{{ route('register') }}" method="post" class="sign__up__form">
                        @csrf
                        <p>
                            <label for="fname">User Name<span></span></label>
                            <input type="text" id="fname" required name="name" class="@error('name') is-invalid @enderror" placeholder="Username">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                        <p>
                            <label for="email">Email Address <span></span></label>
                            <input type="email" id="email" required autocomplete="off" name="email" class="@error('name') is-invalid @enderror" placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                        <p>
                            <label for="phone">Phone<span></span></label>
                            <input type="text" id="phone" required name="phone" class="@error('phone') is-invalid @enderror" placeholder="Phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                        <p>
                            <label for="password">Password <span></span></label>
                            <input type="password" id="password" name="password" required class="@error('password') is-invalid @enderror" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>
                        <p>
                            <label for="password-confirm">Password <span></span></label>
                            <input type="password" id="password-confirm" required name="password_confirmation">
                        </p>
                       <div class="primary-login">
                            <button class="primary-button" type="submit">Registared</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
