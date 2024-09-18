@extends('layouts.app')
    {{-- @section('navbar')
       @include('layouts.front_partial.collaps_nav')    
    @endsection --}}
@section('content')
@push('css')
@endpush
 <div class="single-profile">
    <div class="container">
        <div class="wrapper">
            <div class="column">
                <div class="profile one">
                    <div class="flexwrap">
                        @include('customer.sidebar')
                        <div class="item right">
                            <div class="column">
                                <div class="sectop flexitem">
                                    <h2><span class="circle"></span><span>Wishlist Products</span></h2>
                                    <div class="second-links">
                                        <a href="{{ route('wishlist.clear') }}" class="view-all" id="delete">Clear all<i class="ri-delete-bin-6-line"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="products main flexwrap">
                                @foreach($wishlist as $row)
                                <div class="item">
                                    <div class="media" style="height: 175px;">
                                        <div class="thumbnall ">
                                            <a href="#">
                                                <img src="{{ asset('public/files/product/'.$row->thumbnail) }}" alt="Not Found Image">
                                            </a>
                                        </div>
                                        <div class="hoverable">
                                            <ul>
                                                <li class="active"><a href="{{ route('remove.wishlist',$row->id) }}"><i class="ri-delete-bin-6-line"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h3 class="main-links"><a href="{{ route('product.details',$row->product_slug) }}">{{ $row->product_name }}</a></h3>
                                        <div class="price">
                                            @if($row->discount_price>0)
                                            <span class="current">{{ $website->currency }}{{ $row->discount_price }}</span>
                                            <span class="normal mini-text">{{ $website->currency }}{{ $row->selling_price }}</span>
                                            @else
                                            <span class="current">{{ $website->currency }}{{ $row->selling_price }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
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

