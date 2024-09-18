@extends('layouts.app')
    {{-- @section('navbar')
       @include('layouts.front_partial.collaps_nav')    
    @endsection --}}
@section('content')
@push('css')
@endpush
@php
$images=json_decode($product->images,true);
$color=explode(',',$product->color);
$size=explode(',',$product->size);
$sum_rating=DB::table('product_reviews')->where('product_id',$product->id)->sum('rating');
$count_rating=DB::table('product_reviews')->where('product_id',$product->id)->count('rating');
@endphp
<div class="single-product">
   <div class="container">
     <div class="wrapper">
         <div class="breadcrumb">
             <ul class="flexitem">
                 <li><a href="{{ url('/') }}">Home</a></li>
                 <li><a href="#">{{ $product->category_name }}</a></li>
                 <li><a href="#">{{ $product->product_name }}</a></li>
             </ul>
         </div>
         <!-- Breadcrumb -->

         <div class="column">
             <div class="products one">
                 <div class="flexwrap">
                     <div class="row">
                         <div class="item is_stick">
                             <div class="price">
                                 <span class="discount">32%<br>OFF</span>
                             </div>
                             @isset($product->images)
                             <div class="big-image">
                                 <div class="big-image-wrapper swiper-wrapper">
                                    @foreach($images as $key => $image)
                                     <div class="image-show swiper-slide">
                                         <a data-fslightbox href="{{ asset('public/files/product/'.$image) }}">
                                             <img src="{{ asset('public/files/product/'.$image) }}" alt="Not Found">
                                         </a>
                                     </div>
                                     @endforeach
                                 </div>
                                 <div class="swiper-button-next"></div>
                                 <div class="swiper-button-prev"></div>
                             </div>
                             @endisset
                             @isset($product->images)
                             <div thumbSlider="" class="small-image">
                                 <ul class="small-image-wrapper flexitem swiper-wrapper">
                                    @foreach($images as $key => $image)
                                     <li class="thumbnail-show swiper-slide">
                                         <img src="{{ asset('public/files/product/'.$image) }}" alt="Not Found">
                                     </li>
                                     @endforeach
                                 </ul>
                             </div>
                             @endisset
                         </div>
                     </div>
                     <div class="row">
                         <div class="item">
                             <h1>{{ $product->product_name }}</h1>
                             <div class="content">
                                 <div class="review-rating rating">
                                     <div class="reting-this">
                                      @if($sum_rating != NULL)
                                        @if(intval($sum_rating/$count_rating) == 5)
                                        <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        @elseif(intval($sum_rating/$count_rating) == 4)
                                        <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill"></i></span>
                                        @elseif(intval($sum_rating/$count_rating) == 3)
                                        <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill"></i></span>
                                        <span><i class="ri-star-fill"></i></span>
                                        @elseif(intval($sum_rating/$count_rating) == 2)
                                        <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill"></i></span>
                                        <span><i class="ri-star-fill"></i></span>
                                        <span><i class="ri-star-fill"></i></span>
                                        @else
                                        <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                        <span><i class="ri-star-fill"></i></span>
                                        <span><i class="ri-star-fill"></i></span>
                                        <span><i class="ri-star-fill"></i></span>
                                        <span><i class="ri-star-fill"></i></span>
                                        @endif
                                      @endif
                                     </div>
                                     <a href="#review" class="mini-text">{{ $review_count }} reviews</a>
                                     <a href="#review-form" class="add-review mini-text">Add New Review</a>
                                 </div>
                                 <div class="stock-sku">
                                    @if($product->stock_quantity>0)
                                     <span class="available">Stock In</span>
                                     @else
                                     <span class="available" style="color:red;">Stock Out</span>
                                     @endif
                                     <span class="sku mini-text">{{ $product->product_code }}</span>
                                 </div>
                                 <div class="price">
                                    @if($product->discount_price>0)
                                    <span class="current">{{ $website->currency }}{{ $product->discount_price }}</span>
                                    <span class="normal mini-text">{{ $website->currency }}{{ $product->selling_price }}</span>
                                    @else
                                    <span class="current">{{ $website->currency }}{{ $product->selling_price }}</span>
                                    @endif
                                </div>
                                 <div class="actions">
                                    <form action="{{ route('add.to.cart') }}" method="post" id="add_cart">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                            @if($product->discount_price==NULL)
                                                <input type="hidden" name="price" value="{{ $product->selling_price }}">
                                            @else
                                                <input type="hidden" name="price" value="{{ $product->discount_price }}">
                                            @endif
                                            @isset($product->size)
                                            <p>
                                                <label for="size">Select Size:</label>
                                                <select name="size" id="size" style="padding: 10px 15px;">
                                                    @foreach($size as $row)
                                                    <option value="{{ $row }}">{{ $row }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            @endisset
                                            @isset($product->color)
                                            <p>
                                                <label for="color">Select Color:</label>
                                                <select name="color" id="color" style="padding: 10px 15px;">
                                                    @foreach($color as $row)
                                                    <option value="{{ $row }}">{{ $row }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            @endisset
                                         <div class="qty-control flexitem">
                                             <button class="minus circle">-</button>
                                             <input type="text" value="1" name="qty">
                                             <button class="plus circle">+</button>
                                         </div>
                                         <br>
                                         <br>
                                         @if($product->stock_quantity>0)
                                         <div class="button-cart"><button type="submit" class="primary-button">Add to Cart</button></div>
                                         @else
                                         <span class="available" style="color:red;">Stock Out</span>
                                         @endif
                                    </form>
                                    <br>
                                    <br>
                                     <div class="wish-share">
                                         <ul class="flexitem second-links">
                                             <li><a href="javascript:void(0)" class="wishlist" style="margin: 21em 2em 2em 2em;" data-id="{{ $product->id }}">
                                                 <span class="icon-large"><i class="ri-heart-line"></i></span>
                                                 <span>Wishlist</span>
                                             </a></li>
                                             <li><a href="#" style="margin: 21em 2em 2em 2em;">
                                                 <span class="icon-large"><i class="ri-share-line"></i></span>
                                                 <span>Share</span>
                                             </a></li>
                                         </ul>
                                     </div>
                                 </div>
                                 <div class="description collapse">
                                     <ul>
                                         <li class="has-child expand">
                                             <a href="#0" class="icon-small">Information</a>
                                             <ul class="content">
                                                 <li><span>Brands</span> <span>{{ $product->brand_name }}</span></li>
                                                 <li><span>Activity</span> @if($product->stock_quantity>0)
                                                       <span class="available">Running</span>
                                                       @else
                                                       <span class="available" style="color:red;">Discontinue</span>
                                                       @endif
                                                       </li>
                                                 <li><span>Category</span> <span>{{ $product->category_name }}</span></li>
                                             </ul>
                                         </li>
                                         <li class="has-child">
                                             <a href="#0" class="icon-small">Details</a>
                                             <div class="content">
                                                 <p>{!! $product->description !!}</p>
                                             </div>
                                         </li>
                                         <li class="has-child">
                                             <a href="#" class="icon-small">Custom</a>
                                             <div class="content">
                                                 <table>
                                                     <thead>
                                                         <tr>
                                                             <th>Size</th>
                                                             <th>Bust <span class="mini-text">(cm)</span></th>
                                                             <th>Waist <span class="mini-text">(cm)</span></th>
                                                             <th>Hip <span class="mini-text">(cm)</span></th>
                                                         </tr>
                                                     </thead>
                                                     <tbody>
                                                         <tr>
                                                             <td>XS</td>
                                                             <td>82,5</td>
                                                             <td>62</td>
                                                             <td>87,5</td>
                                                         </tr>
                                                         <tr>
                                                             <td>S</td>
                                                             <td>85</td>
                                                             <td>63,5</td>
                                                             <td>89</td>
                                                         </tr>
                                                         <tr>
                                                             <td>M</td>
                                                             <td>87,5</td>
                                                             <td>67,5</td>
                                                             <td>93</td>
                                                         </tr>
                                                         <tr>
                                                             <td>L</td>
                                                             <td>90</td>
                                                             <td>72,5</td>
                                                             <td>98</td>
                                                         </tr>
                                                         <tr>
                                                             <td>XL</td>
                                                             <td>93</td>
                                                             <td>77,5</td>
                                                             <td>103</td>
                                                         </tr>
                                                     </tbody>
                                                 </table>
                                             </div>
                                         </li>
                                         <li class="has-child">
                                             <a href="#" class="icon-small">Reviews <span class="mini-text">( {{ $review_count }} )</span></a>
                                             <div class="content">
                                                 <div class="reviews">
                                                     <h4>Customers Reviews</h4>
                                                     <div class="review-block">
                                                         <div class="review-block-head">
                                                             <div class="flexitem">
                                                                <span class="rate-sum">{{ $sum_rating }}</span>
                                                                 <span>{{ $review_count }} Reviews</span>
                                                             </div>
                                                             <a href="#review-form" class="secondary-button">Write review</a>
                                                         </div>
                                                         <div class="review-block-body" id="review">
                                                             <ul>
                                                                @foreach($review as $row)
                                                                 <li class="item">
                                                                     <div class="review-form">
                                                                         <p class="person">{{ $row->name }}</p>
                                                                         <p class="mini-text">On {{ date('d / m / Y'), strtotime($row->review_date) }}</p>
                                                                     </div>
                                                                     <div class="review-rating rating">
                                                                          <div class="rate-this">
                                                                            @if($row->rating==5)
                                                                            <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            @elseif($row->rating==4)
                                                                            <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            @elseif($row->rating==3)
                                                                            <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            @elseif($row->rating==2)
                                                                            <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                            @elseif($row->rating==1)
                                                                            <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                                                           @endif

                                                                        </div>
                                                                     </div>
                                                                     <div class="review-title">
                                                                         <p>{{ $row->summary }}</p>
                                                                     </div>
                                                                     <div class="review-text">
                                                                         <p>{{ $row->review }}</p>
                                                                     </div>
                                                                 </li>
                                                                 @endforeach
                                                             </ul>
                                                             <div class="second-links">
                                                                 <a href="#" class="view-all">View all review<i class="ri-arrow-right-line"></i></a>
                                                             </div>
                                                         </div>
                                                         <div id="review-form" class="review-form">
                                                             <h4>Write a review</h4>
                                                            <form method="post" action="{{ route('review.store') }}" id="add_form">
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                             <div class="rating">
                                                                <p style="margin-top: 17px;">
                                                                    <label for="rating">Are you satisfied enough?</label>
                                                                    <select name="rating" id="rating" style="padding: 10px 15px;">
                                                                        <option value="1">1 Star</option>
                                                                        <option value="2">2 Star</option>
                                                                        <option value="3">3 Star</option>
                                                                        <option value="4">4 Star</option>
                                                                        <option value="5">5 Star</option>
                                                                    </select>
                                                                </p>
                                                                 
                                                             </div>
                                                                 <p>
                                                                     <label for="summary">Summary</label>
                                                                     <input type="text" id="summary" name="summary" required>
                                                                 </p>
                                                                 <p>
                                                                     <label for="review">Review</label>
                                                                     <textarea name="review" id="review" cols="30" rows="10" required></textarea>
                                                                 </p>
                                                                 @if(Auth::check())
                                                                 <p><button type="submit" class="primary-button" style="outline:none; border:none;">Submit Review</button></p>
                                                                 @else
                                                                 <p style="color:red; font-size: 10px;">Please at first login your account for submit & review.</p>
                                                                 @endif
                                                             </form>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
        </div>
     </div>
 </div>
</div>

<!-- Related product you can copy the structur
 form featurd product at page home -->
 <div class="featured">
     <div class="container">
         <div class="wrapper">
             <div class="column">
                 <div class="sectop flexitem">
                     <h2><span class="circle"></span><span>Related Products</span></h2>
                 </div>
             </div>
             <div class="products main flexwrap">
               @foreach($related_product as $row)
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
                                 <li><a href="javascript:void(0)" class="compare" data-id="{{ $row->id }}"><i class="ri-shuffle-line"></i></a></li>
                             </ul>
                         </div>
                     </div>
                     <div class="content">
                         <div class="review-rating rating">
                            @isset($review)
                            <div class="reting-this">
                              @if($sum_rating != NULL)
                                @if(intval($sum_rating/$count_rating) == 5)
                                <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                @elseif(intval($sum_rating/$count_rating) == 4)
                                <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                @elseif(intval($sum_rating/$count_rating) == 3)
                                <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                @elseif(intval($sum_rating/$count_rating) == 2)
                                <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                @else
                                <span style="min-width: 0;"><i class="ri-star-fill" style="color:#ffa202;"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                @endif
                              @endif
                             </div>
                             <span class="mini-text">({{ $review_count }})</span>
                            @endisset
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
    //add Form Submit
    $('#add_form').submit(function(e){
      e.preventDefault();
      var url=$(this).attr('action');
      var request=$(this).serialize();
      $.ajax({
        url:url,
        type:'post',
        async:false,
        data:request,
        success:function(data){
            if(data.error) {
                toastr.error(data.error);
            }else{
                toastr.success(data.success);
            }
            $('#add_form')[0].reset();
        }
      });
    });
    // Submit Form & store-----------
    $('#add_cart').submit(function(e){
      e.preventDefault();
       var url = $(this).attr('action');
       var request = $(this).serialize();
      $.ajax({
          url:url,
          type:'post',
          async:false,
          data:request,
          success:function(data){
            toastr.success(data);
            $('#add_to_cart')[0].reset();
            cart();
          }
       });
    });
</script>
@endpush
@endsection