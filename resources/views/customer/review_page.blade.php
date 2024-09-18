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
                            @isset($check)
                            <h1 style="text-align: center; margin-top:15px">Update Your Review:</h1>
                            <br>
                            <form action="{{ route('review.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $check->id }}">
                               <p>
                                <label for="rating">Select Rating</label>
                                <select name="rating" id="rating" style="padding: 10px 15px;">
                                    <option value="1" @if($check->rating==1) selected="" @endif>1 Star</option>
                                    <option value="2" @if($check->rating==2) selected="" @endif>2 Star</option>
                                    <option value="3" @if($check->rating==3) selected="" @endif>3 Star</option>
                                    <option value="4" @if($check->rating==4) selected="" @endif>4 Star</option>
                                    <option value="5" @if($check->rating==5) selected="" @endif>5 Star</option>
                                </select>
                                <p>
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" cols="20" rows="10" style="line-height: 18px">{{ $check->message }}</textarea>
                                </p>
                                <div class="primary-checkout">
                                    <button class="primary-button" type="submit">Update</button>
                                </div>
                            </form>
                            @else
                            <h1 style="text-align: center; margin-top:15px">Write Your Review:</h1>
                            <br>
                            <form action="{{ route('review.store') }}" method="post">
                                @csrf
                                <p>
                                    <label for="rating">Select Rating</label>
                                    <select name="rating" id="rating" style="padding: 10px 15px;">
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5">5 Star</option>
                                    </select>
                                </p>
                                <p>
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" cols="20" rows="10" style="line-height: 18px"></textarea>
                                </p>
                                <div class="primary-checkout">
                                    <button class="primary-button" type="submit">Send</button>
                                </div>
                            </form>
                            @endisset
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

