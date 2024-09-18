@extends('layouts.app')
    {{-- @section('navbar')
       @include('layouts.front_partial.collaps_nav')    
    @endsection --}}
@section('content')
@push('css')
@endpush
<div class="single-checkout">
    <div class="container">
        <div class="wrapper">
            <div class="checkout flexwrap">
                <div class="item left styled">
                    <h1>Customer Billing Address</h1>
                    <form action="{{ route('order.place') }}" method="post">
                     @csrf
                        <p>
                            <label for="name">Customer Name <span></span></label>
                            <input type="text" id="name" name="c_name" required value="{{ Auth::user()->name }}">
                        </p>
                        <p>
                            <label for="phone">Phone Number <span></span></label>
                            <input type="text" id="phone" required name="c_phone" value="{{ Auth::user()->phone }}">
                        </p>
                        <p>
                            <label for="email">Email Address <span></span></label>
                            <input type="email" id="email" required autocomplete="off" name="c_email">
                        </p>
                        <p>
                            <label for="address">Shipping Address <span></span></label>
                            <input type="text" id="address" required name="c_address">
                        </p>
                        <p>
                            <label for="country">Country <span></span></label>
                           <input type="text" name="country" id="country" required>
                        </p>
                        <p>
                            <label for="city">City <span></span></label>
                            <input type="text" id="city" name="city">
                        </p>
                        <p>
                            <label for="postal">Zip / Postal Code <span></span></label>
                            <input type="number" id="postal" required name="zip_code">
                        </p>
                        <p>
                            <label for="exter_phone">Exter Phone</label>
                           <input type="text" name="exter_phone" id="exter_phone">
                        </p>
                       
                        <div class="shipping-methods">
                            <h2>Payment Methods</h2>
                            <p>
                                <input type="radio" name="payment_type" value="Paypal">
                                <label>Paypal</label>
                            </p>
                            <p>
                                <input type="radio" checked name="payment_type" value="Aamerpay">
                                <label>Bkash/Nagad/Rocket</label>
                            </p>
                            <p>
                                <input type="radio" name="payment_type" value="Hand Cash">
                                <label>Hand Cash</label>
                            </p>
                        </div>
                        <div class="primary-checkout">
                            <button class="primary-button" type="submit">Place Order</button>
                        </div>
                    </form>
                </div>
                <style type="text/css">
                   .coupon form input{
                     font-size: 1.1em; 
                     outline: 0; 
                     width: var(--percent100); 
                     padding: 0 1.5em; line-height: 50px;
                     background-color: var(--white-color);
                     border: 3px solid var(--secondary-dark-color);
                   }
                   .coupon form button{
                     position: absolute; 
                     top: 0; 
                     right: 0; 
                     border: 0; 
                     outline: 0; 
                     font-size: 1em; 
                     padding: 0 2.5em; 
                     line-height: 56px; 
                     background-color: var(--secondary-dark-color); 
                     color: var(--white-color); cursor: pointer;
                   }
                </style>
                <div class="item right">
                  @if(!Session::has('coupon'))
                   <div class="coupon">
                       <form action="{{ route('apply.coupon') }}" method="post">
                           @csrf
                           <input type="text" placeholder="Enter coupon" required name="coupon">
                           <button type="submit">Apply</button>
                       </form>
                   </div>
                   @endif
                    <h2>Order Summary</h2>
                    <div class="summary-order is_sticky">
                        <div class="summary-totals">
                            <ul>
                                <li>
                                    <span>Subtotal</span>
                                    <span>{{ $website->currency }}{{ Cart::subtotal() }}</span>
                                </li>
                                @if(Session::has('coupon'))
                                 <li>
                                    <span>Coupon: ( {{ Session::get('coupon')['name'] }} )</span>
                                    <span> <a href="{{ route('coupon.remove') }}" style="padding: 4px; background: red; border-radius: 4px; color:#FFF;"><i class="ri-close-line"></i></a>  {{ $website->currency }}{{ Session::get('coupon')['discount'] }}</span>
                                </li>
                                @endif
                                <li>
                                    <span>Tex</span>
                                    <span>{{ $website->currency }}0.00%</span>
                                </li>
                                <li>
                                    <span>Shipping</span>
                                    <span>{{ $website->currency }}0.00</span>
                                </li>
                                @if(Session::has('coupon'))
                                <li>
                                    <span>Total</span>
                                    <strong>{{ $website->currency }}{{ Session::get('coupon')['after_discount'] }}</strong>
                                </li>
                                @else
                                <li>
                                    <span>Total</span>
                                    <strong>{{ $website->currency }}{{ Cart::total() }}</strong>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <ul class="products mini">
                           @foreach($content as $row)
                            <li class="item">
                                <div class="thumbnall object-cover">
                                    <img src="{{ asset('public/files/product/'.$row->options->thumbnail) }}" alt="Not Found Image">
                                </div>
                                <div class="item-content">
                                    <p>{{ $row->name }}</p>
                                    <span class="price">
                                        <span>{{ $website->currency }}{{ $row->price }}</span>
                                        <span>x{{ $row->qty }}</span>
                                    </span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
@endpush
@endsection