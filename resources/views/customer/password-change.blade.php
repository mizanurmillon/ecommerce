@extends('layouts.app')
        
@section('content')
{{-- @include('layouts.front_partial.collaps_nav') --}}
@push('css')
@endpush
 <div class="single-profile">
    <div class="container">
        <div class="wrapper">
            <div class="column">
                <div class="profile one">
                    <div class="flexwrap">
                        @include('customer.sidebar')
                        <div class="item right" style="margin-top: 30px; margin-bottom: 20px; padding:10px; border: 1px solid #DDD;">
                            <h1 style="text-align: center; margin-top:15px">Password Change</h1>
                            <br>
                            <form action="{{ route('update.password') }}" method="post">
                                @csrf
                                <p>
                                    <label for="password">Old Password</label>
                                    <input type="password" id="password" required name="old_password" placeholder="Enter old password">
                                </p>
                                <p>
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="@error('password') is-invalid @enderror" id="new_password" name="password" required placeholder="Enter new password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color:red; ">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </p>
                                <p>
                                    <label for="confrm">Confrm Password</label>
                                    <input type="password" id="confrm" name="password_confirmation" required placeholder="re-type password">
                                </p>
                                <div class="primary-checkout" style="margin-bottom: 15px;">
                                    <button class="primary-button" type="submit">Password Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>
@push('js')
@endpush
@endsection

