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
                    <h2><span class="circle"></span><span>Featured Products</span></h2>
                </div>
            </div>
            <div class="products main flexwrap">
                @foreach($featured_product as $row)
                <div class="item">
                    <div class="media">
                        <div class="thumbnall object-cover">
                            <a href="#">
                                <img src="{{ asset('public/files/product/'.$row->thumbnail) }}" alt="Not Found Image">
                            </a>
                        </div>
                        <div class="hoverable">
                            <ul>
                                <li class="active"><a href="javascript:void(0)" class="wishlist" data-id="{{ $row->id }}"><i class="ri-heart-line"></i></a></li>
                                <li><a href="javascript:void(0)" class="compare" data-id="{{ $row->id }}"><i class="ri-arrow-left-right-line"></i></a></li>
                            </ul>
                        </div>
                        <div class="discount circle flexcenter"><span>31%</span></div>
                    </div>
                    <div class="stock mini-text" style="margin-top: 10px;" data-stock="{{ $row->stock_quantity }}">
                        <div class="qty">
                            <span>Stock: <strong class="qty-available">{{ $row->stock_quantity }}</strong></span>
                            <span>Sold: <strong class="qty-sold">30</strong></span>
                        </div>
                        <div class="bar">
                            <div class="available"></div>
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
@push('js')
<script type="text/javascript">
    //add wishlist
    $('body').on('click','.wishlist',function(){
      var id=$(this).attr('data-id');
      $.ajax({
        url: "{{ url('/add-to-wishlist/') }}/"+id,
        type:'get',
        success:function(data){
            wishlist();
         if(data.error) {
            toastr.error(data.error);
         }else{
            toastr.success(data.success);
         }
        }
      })
    });

    //add compare
    $('body').on('click','.compare',function(){
      var id=$(this).attr('data-id');
      $.ajax({
        url: "{{ url('/add-to-compare/') }}/"+id,
        type:'get',
        success:function(data){
            compare();
         if(data.error) {
            toastr.error(data.error);
         }else{
            toastr.success(data.success);
         }
        }
      })
    });
</script>
@endpush
@endsection