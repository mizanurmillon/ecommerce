@extends('layouts.app')
    @section('navbar')
        @include('layouts.front_partial.main_nav')
    @endsection
@section('content')
@push('css')
@endpush
@include('layouts.front_partial.slider')
<div class="brands">
    <div class="container">
        <div class="wrapper flexitem">
            @foreach($brand as $row)
            <div class="item">
                <a href="{{ route('brandwise.product',$row->id) }}" title="{{ $row->brand_name }}">
                    <img src="{{ asset('public/files/brand/'.$row->brand_logo) }}" alt="Not Found Image" style="width: 60px; height:40px ">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Brands -->

<div class="trending">
    <div class="container">
        <div class="wrapper">
            <div class="sectop flexitem">
                <h2><span class="circle"></span><span>Trending Products</span></h2>
            </div>
            <div class="column">
                <div class="flexwrap">
                    <div class="row products big">
                        <div class="item">
                            <div class="offer">
                                <p>Offer ends at</p>
                                <ul class="flexcenter">
                                    <li>1</li>
                                    <li>15</li>
                                    <li>27</li>
                                    <li>60</li>
                                </ul>
                            </div>
                            <div class="media" style="min-height: 278px;">
                                <div class="image">
                                    <a href="#">
                                        <img src="{{ asset('public/files/product/'.$today_deal->thumbnail) }}" alt="Not Found Image">
                                    </a>
                                </div>
                                <div class="hoverable">
                                    <ul>
                                        <li class="active"><a href="javascript:void(0)" class="wishlist" data-id="{{ $today_deal->id }}"><i class="ri-heart-line"></i></a></li>
                                        <li><a href="javascript:void(0)" class="compare" data-id="{{ $today_deal->id }}"><i class="ri-arrow-left-right-line"></i></a></li>
                                    </ul>
                                </div>
                                <div class="discount circle flexcenter"><span>31%</span></div>
                            </div>
                            <div class="content">
                                <h3 class="main-links"><a href="{{ route('today.product',$today_deal->product_slug) }}">{{ $today_deal->product_name }}</a></h3>
                                <div class="price">
                                    @if($today_deal->discount_price>0)
                                    <span class="current">{{ $website->currency }}{{ $today_deal->discount_price }}</span>
                                    <span class="normal mini-text">{{ $website->currency }}{{ $today_deal->selling_price }}</span>
                                    @else
                                    <span class="current">{{ $website->currency }}{{ $today_deal->selling_price }}</span>
                                    @endif
                                </div>
                                <div class="stock mini-text" data-stock="{{ $today_deal->stock_quantity }}">
                                    <div class="qty">
                                        <span>Stock: <strong class="qty-available">{{ $today_deal->stock_quantity }}</strong></span>
                                        <span>Sold: <strong class="qty-sold">459</strong></span>
                                    </div>
                                    <div class="bar">
                                        <div class="available"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Trending Products --}}
                    <div class="row products mini">
                        @foreach($trending_product as $row)
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
                                <div class="discount circle flexcenter"><span>37%</span></div>
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
                                <div class="mimi-text">
                                    <p>2584 sold</p>
                                    <p>Free Shipping</p>
                                    <p class="stock-danger">Stock {{ $row->stock_quantity }} left!</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{-- random_product --}}
                    <div class="row products mini">
                        @foreach($random_product as $row)
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
                                <div class="discount circle flexcenter"><span>32%</span></div>
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
                                <div class="mimi-text">
                                    <p>2975 sold</p>
                                    <p>Free Shipping</p>
                                    <p class="stock-danger">Stock {{ $row->stock_quantity }} left!</p>
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
<!-- Trending Products -->

<div class="featured">
    <div class="container">
        <div class="wrapper">
            <div class="column">
                <div class="sectop flexitem">
                    <h2><span class="circle"></span><span>Featured Products</span></h2>
                    <div class="second-links">
                        <a href="#" class="view-all"> View all <i class="ri-arrow-right-line"></i></a>
                    </div>
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
<!-- Featured Products -->
<div class="banners">
    <div class="container">
        <div class="wrapper">
            <div class="column">
                <div class="banner flexwrap">
                    <div class="row">
                        <div class="item">
                            <div class="image">
                                <img src="{{ asset('public/frontend') }}/assets/banner/banner1.jpg" alt="Not Found Image">
                            </div>
                            <div class="text-content flexcol">
                                <h4>Beutal Sale!</h4>
                                <h3><span>Get the deal in here</span><br>Living Room Chair</h3>
                                <a href="{{ route('all.product') }}" class="primary-button">Shop Now</a>
                            </div>
                            <a href="#" class="over-link"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="item get-gray">
                            <div class="image">
                                <img src="{{ asset('public/frontend') }}/assets/banner/banner2.jpg" alt="Not Found Image">
                            </div>
                            <div class="text-content flexcol">
                                <h4>Beutal Sale!</h4>
                                <h3><span>Biscount evryday</span><br>Office Outfit</h3>
                                <a href="{{ route('all.product') }}" class="primary-button">Shop Now</a>
                            </div>
                            <a href="#" class="over-link"></a>
                        </div>
                    </div>
                </div>
                <!-- Banners -->
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