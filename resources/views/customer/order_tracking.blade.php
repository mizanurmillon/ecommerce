@extends('layouts.app')
        
@section('content')
{{-- @include('layouts.front_partial.collaps_nav') --}}
@push('css')
@endpush
<style type="text/css">
    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
    }
</style>
 <div class="single-profile">
    <div class="container">
        <div class="wrapper">
            <div class="column">
                <div class="profile one">
                    <div class="flexwrap">
                        <div class="item" style="margin-top: 30px; margin-bottom: 20px; padding:10px; border: 1px solid #DDD; width: 70%; margin-left: 15%;">
                            {{-- All reply message show --}}
                            <form action="{{ route('chack.order') }}" method="post">
                                @csrf 
                                <h3 style="text-align: center;">Track Your Order Now</h3>
                               <div class="card-body">
                                    <p>
                                        <label for="order_id">Order ID:</label>
                                        <input type="text" name="order_id" required id="order_id" placeholder="Write Your Order Id">
                                    </p>
                                    <div class="primary-checkout">
                                        <button class="primary-button" type="submit">Track Now</button>
                                    </div>
                               </form>
                            </div>
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

