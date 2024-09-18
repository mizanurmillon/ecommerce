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
                            <strong>Submit your ticket we will reply.</strong>
                            <br>
                            <br>
                            <form action="{{ route('store.ticket') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <p>
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" required id="subject">
                                </p>
                                <p>
                                    <label for="service">Service</label>
                                    <select name="service" id="service" style="padding: 10px 15px; background: #fff; border: 1px solid #DDD;">
                                        <option value="Technicel">Technicel</option>
                                        <option value="Payment">Payment</option>
                                        <option value="Affiliate">Affiliate</option>
                                        <option value="Return">Return</option>
                                        <option value="Refund">Refund</option>
                                    </select>
                                </p>
                                <p>
                                    <label for="prortity">Prortity</label>
                                    <select name="prortity" id="prortity" style="padding: 10px 15px; background: #fff; border: 1px solid #DDD;">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </p>
                                <p>
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" cols="15" rows="7" style="line-height: 18px"></textarea>
                                </p>
                                <p>
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image">
                                </p>
                                <div class="primary-checkout">
                                    <button class="primary-button" type="submit">Submit Ticket</button>
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

