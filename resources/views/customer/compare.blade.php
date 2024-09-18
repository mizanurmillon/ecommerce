@extends('layouts.app')
{{-- @include('layouts.front_partial.collaps_nav') --}}
@section('content')
@push('css')
@endpush

<div class="featured">
    <div class="container">
        <div class="wrapper">
            <div class="column">
                <div class="sectop flexitem">
                    <h2><span class="circle"></span><span>Compare Products</span></h2>
                    <div class="second-links">
                        <a href="{{ route('compare.clear') }}" class="view-all" style="color:red;"> Reset Compare List <i class="ri-delete-bin-6-line"></i></a>
                    </div>
                </div>
            </div>
            <div class="products main flexwrap">
                @foreach($compare as $row)
                <div class="item">
                    <div class="media">
                        <div class="thumbnall object-cover">
                            <a href="#">
                                <img src="{{ asset('public/files/product/'.$row->thumbnail) }}" alt="Not Found Image">
                            </a>
                        </div>
                    </div>
                    <div class="stock mini-text" style="margin-top: 10px;">
                        <div class="qty">
                            <span>Category: <strong class="qty-available">{{ $row->category_name }}</strong></span>
                            <span>Brand: <strong class="qty-sold">{{ $row->brand_name }}</strong></span>
                        </div>
                    </div>
                    <div class="content">
                        <div class="price">
                            @if($row->discount_price>0)
                            <span class="current">{{ $website->currency }}{{ $row->discount_price }}</span>
                            <span class="normal mini-text">{{ $website->currency }}{{ $row->selling_price }}</span>
                            @else
                            <span class="current">{{ $website->currency }}{{ $row->selling_price }}</span>
                            @endif
                        </div>
                        <h3 class="main-links"><a href="{{ route('product.details',$row->product_slug) }}">{{ $row->product_name }}</a></h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@push('js')
@endpush
@endsection