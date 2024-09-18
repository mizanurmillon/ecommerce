@extends('layouts.app')
    {{-- @section('navbar')
       @include('layouts.front_partial.collaps_nav')    
    @endsection --}}
@section('content')
@push('css')
@endpush
<div class="single-category">
    <div class="container">
        <div class="wrapper">
            <div class="column">
                <div class="holder">
                    <div class="row sidebar">
                         <div class="filter">
                            <div class="filter-block">
                                <h4>Category</h4>
                                <ul>
                                    @foreach($category as $row)
                                    <li><a href="{{ route('categorywise.product',$row->id) }}">
                                            <span>{{ $row->category_name }}</span>
                                        </a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="filter-block">
                                <h4>Subcategory</h4>
                                <ul>
                                    @foreach($subcategory as $row)
                                    <li><a href="{{ route('subcategorywise.product',$row->id) }}">
                                        <span>{{ $row->subcategory_name }}</span>
                                    </a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="filter-block">
                                <h4>Brands</h4>
                                <ul>
                                    @foreach($brands as $row)
                                    <li><a href="{{ route('brandwise.product',$row->id) }}">
                                        <span>{{ $row->brand_name }}</span>
                                     </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="section">
                        <div class="row">
                            <div class="cat-head">
                                <div class="breadcrumb">
                                    <ul class="flexitem">
                                        <li><a href="{{ url('/') }}">Home</a></li>
                                        <li>{{ $brand->brand_name }}</li>
                                    </ul>
                                </div>
                                <div class="page-title" style="padding-bottom: 0;">
                                    <h1>{{ $brand->brand_name }}</h1>
                                </div>
                                <div class="cat-navigation flexitem">
                                    <div class="item-filter desktop-hide">
                                        <a href="#" class="filter-trigger label">
                                            <i class="ri-menu-2-line ri-2x"></i>
                                            <span>Filter</span>
                                        </a>
                                    </div>
                                    <div class="item-sortir">
                                        <div class="lavel">
                                           <span class="mobile-hide">Sort by default</span>
                                           <div class="desktop-hide">Default</div>
                                           <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                        <ul>
                                            <li>Default</li>
                                            <li>Product Name</li>
                                            <li>Price</li>
                                            <li>Brand</li>
                                        </ul>
                                    </div>
                                    <div class="item-perpage mobile-hide">
                                        <div class="lavel">Item 10 per page</div>
                                        <div class="desktop-hide">10</div>
                                    </div>
                                    <div class="item-options">
                                        <div class="lavel">
                                           <span class="mobile-hide">Show 10 per page</span>
                                           <div class="desktop-hide">10</div>
                                           <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                        <ul>
                                            <li>10</li>
                                            <li>20</li>
                                            <li>30</li>
                                            <li>ALL</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Category Products  -->
                        <div class="products main flexwrap">
                            @foreach($product as $row)
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
                                <div class="content">
                                    <div class="rating">
                                        <div class="stars"></div>
                                        <span class="mini-text">(2,548)</span>
                                    </div>
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
                        <div class="lode-more flexcenter">
                            <a href="#" class="secondary-button">Lode More</a>
                        </div>
                    </div>
                </div>
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