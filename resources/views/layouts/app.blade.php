<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ecommerce Website</title>
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/fonts/remixicon.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/swiper-bundle.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.css">
    <!-- Toastr css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/style.css">
    @stack('css')
</head>
<body>
    <div class="site page-home" id="page">
        <header>
            <aside class="site-off desktop-hide">
                <div class="off-canvas">
                    <div class="canvas-head flexitem">
                        <div class="logo"><a href="{{ route('home') }}"><span class="circle"></span>.Store</a></div>
                        <a href="#" class="t-close flexcenter"><i class="ri-close-fill"></i></a>
                    </div>
                    <div class="department"></div>
                    <nav></nav>
                    <div class="thetop-nav"></div>
                </div>
            </aside>
            <div class="header-top mobile-hide">
                <div class="container">
                    <div class="wrapper flexitem">
                        <div class="left">
                            <ul class="flexitem main-links">
                                <li><a href="#">Blog</a></li>
                                <li><a href="{{ route('all.featured.product') }}">Featured Products</a></li>
                                <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                            </ul>
                        </div>
                        <div class="right">
                            <ul class="flexitem main-links">
                                <li><a href="{{ route('order.tracking') }}">Order Tracking</a></li>
                                <li><a href="#">Currency<span class="icon-small"><i class="ri-arrow-down-s-line"></i></span></a>
                                    <ul>
                                        <li class="current"><a href="#">USD</a></li>
                                        <li><a href="#">EURO</a></li>
                                        <li><a href="#">GBP</a></li>
                                        <li><a href="#">IDR</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Language<span class="icon-small"><i class="ri-arrow-down-s-line"></i>    </span></a>
                                    <ul>
                                        <li class="current"><a href="#">English</a></li>
                                        <li><a href="#">German</a></li>
                                        <li><a href="#">Spanish</a></li>
                                        <li><a href="#">Bahasa</a></li>
                                    </ul>
                                </li>
                                
                                @guest
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                                @else
                                <li><a href="{{ route('home') }}">{{ Auth::user()->name }}</a></li>
                                <li><a href="{{ route('logout') }}" id="logout">Logout</a></li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header top -->

            @php
            $category=DB::table('categories')->get();
            $women=DB::table('subcategories')->where('category_id',6)->limit(4)->get();
            $brand=DB::table('brands')->where('brands.status',1)->get();
            $product_count=DB::table('products')->where('status',1)->count();
            @endphp

            <div class="header-nav">
                <div class="container">
                    <div class="flexitem wrapper">
                        <a href="#" class="trigger desktop-hide"><span class="i ri-menu-2-line"></span></a>
                        <div class="left flexitem">
                            <div class="logo"><a href="{{ url('/') }}"><span class="circle"></span>.Store</a></div>
                            <nav class="mobile-hide">
                                <ul class="flexitem second-links">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ route('all.product') }}">Shop</a></li>
                                    <li class="has-child"><a href="#">Women
                                        <div class="icon-small"><i class="ri-arrow-down-s-line"></i></div></a>
                                        <div class="mega">
                                            <div class="container">
                                                <div class="wrapper">
                                                    @foreach($women as $row)
                                                    @php
                                                    $childcategory=DB::table('childcategories')->where('subcategory_id',$row->id)->get();
                                                    @endphp
                                                    <div class="flexcol">
                                                        <div class="row">
                                                            <h4>{{ $row->subcategory_name }}</h4>
                                                            <ul>
                                                                @foreach($childcategory as $row)
                                                                <li><a href="#">{{ $row->childcategory_name }}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        
                                                    </div>
                                                    @endforeach
                                                    <div class="flexcol">
                                                        <div class="row">
                                                            <h4>Top Brands</h4>
                                                            <ul class="women-brands">
                                                                 @foreach($brand as $row)
                                                                <li><a href="{{ route('brandwise.product',$row->id) }}">{{ $row->brand_name }}</a></li>
                                                                @endforeach
                                                                
                                                            </ul>
                                                            <a href="#" class="view-all">View all brands  <i class="ri-arrow-right-line"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="flexcol products">
                                                        <div class="row">
                                                            <div class="media">
                                                                <div class="thumbnall object-cover">
                                                                    <a href="#">
                                                                    <img src="{{ asset('public/frontend') }}/assets/products/apparel4.jpg" alt="Not image">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="text-content">
                                                                <h4>Most wented</h4>
                                                                <a href="#" class="primary-button">Order Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="#">Men</a></li>
                                    <li><a href="#">Sports
                                        <div class="fly-item"><span>New!</span></div>
                                    </a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="right">
                            <ul class="flexitem second-links">
                                 <li class="mobile-hide"><a href="{{ route('compare') }}">
                                    <div class="icon-large"><i class="ri-arrow-left-right-line"></i></div>
                                    <div class="fly-item"><span class="item-number" id="compare_count"></span></div>
                                </a></li>
                                <li class="mobile-hide"><a href="{{ route('wishlist') }}">
                                    <div class="icon-large"><i class="ri-heart-3-line"></i></div>
                                    <div class="fly-item"><span class="item-number" id="wishlist_count"></span></div>
                                </a></li>
                                <li class="iscart"><a href="{{ route('my.cart') }}">
                                        <div class="icon-large">
                                            <i class="ri-shopping-cart-line"></i>
                                            <div class="fly-item"><span class="item-number cart_qty"></span></div>
                                        </div>
                                        <div class="icon-text">
                                            <div class="mini-text">Total</div>
                                            <div class="cart-total cart_total"></div>
                                        </div>
                                    </a>
                                    <div class="mini-cart">
                                        <div class="content">
                                            <div class="cart-head">
                                                <span class="cart_qty"></span> items in cart
                                            </div>
                                            <div class="cart-body">
                                                <ul class="products mini">
                                                    @foreach(Cart::content() as $row)
                                                    <li class="item">
                                                        <div class="thumbnall object-cover">
                                                            <a href="#"><img src="{{ asset('public/files/product/'.$row->options->thumbnail) }}" alt="Not Found Image"></a>
                                                        </div>
                                                        <div class="item-content">
                                                            <p><a href="#">{{ $row->name }}</a></p>
                                                            <span class="price">
                                                                <span>{{ $website->currency }}{{ $row->price * $row->qty }}</span>
                                                                <span class="fly-item"><span>{{ $row->qty }}x</span></span>
                                                            </span>
                                                        </div>
                                                        <a href="javascript:void(0)" data-id="{{ $row->rowId }}" class="item-remove"><i class="ri-close-line"></i></a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="cart-footer">
                                                <div class="subtotal">
                                                    <p>Subtotal</p>
                                                    <p><strong>{{ $website->currency }}{{ Cart::subtotal() }}</strong></p>
                                                </div>
                                                <div class="actions">
                                                    <a href="/cart.html" class="primary-button">Checkout</a>
                                                    <a href="{{ route('my.cart') }}" class="secondary-button">View Cart</a>
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
            <!-- Header Nav -->
             <div class="header-main mobile-hide">
                <div class="container">
                    <div class="wrapper flexitem">
                        <div class="left">
                            <div class="dpt-cat">
                                <div class="dpt-head">
                                    <div class="main-text">All Department</div>
                                    <div class="mini-text mobile-hide">Total ( {{ $product_count }} ) Products</div>
                                    <a href="#" class="dpt-trigger mobile-hide">
                                        <i class="ri-menu-3-line"></i>
                                    </a>
                                </div>
                                @yield('navbar')
                            </div>
                        </div>
                        <div class="right">
                            <div class="search-box">
                                <form action="#" class="search">
                                    <span class="icon-large"><i class="ri-search-line"></i></span>
                                    <input type="search" placeholder="Search for products">
                                    <button type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </header>
        <!-- Header -->

        <main>
            @yield('content')
        </main>

        <footer>
            
            <div class="newsletter">
                <div class="container">
                    <div class="wrapper">
                        <div class="box">
                            <div class="content">
                                <h3>Join Our Newsletter</h3>
                                <p>Get E-mail updates about our latest shop and <strong>special offers</strong></p>
                            </div>
                            <form action="{{ route('store.newsletter') }}" method="post" class="search" id="newsletter_form">
                                @csrf
                                <span class="icon-large"><i class="ri-mail-line"></i></span>
                                <input type="email" required placeholder="Your email address" name="email">
                                <button type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Newsletter -->

            <div class="widgets">
                <div class="container">
                    <div class="wrapper">
                        <div class="flexwrap">
                            <div class="row">
                                <div class="item mini-links">
                                    <h4>Help & Contact</h4>
                                    <ul class="">
                                        <li><a href="{{ route('home') }}">Your Account</a></li>
                                        <li><a href="{{ route('order.tracking') }}">Orders Tracking</a></li>
                                        <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                                        <li><a href="{{ route('user.review') }}">Customer reviews</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="item mini-links">
                                    <h4>Products Categories</h4>
                                    <ul>
                                        @foreach($category as $row)
                                        <li><a href="{{ route('categorywise.product',$row->id) }}">{{ $row->category_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="item mini-links">
                                    <h4>Payment Info</h4>
                                    <ul class="">
                                        <li><a href="#">Bussiness Card</a></li>
                                        <li><a href="#">Shop with Points</a></li>
                                        <li><a href="#">Reload Your Balance</a></li>
                                        <li><a href="#">PayPal</a></li>
                                    </ul>
                                </div>
                            </div>
                            @php
                            $page=DB::table('pages')->get();
                            @endphp
                            <div class="row">
                                <div class="item mini-links">
                                    <h4>QUICK LINKS</h4>
                                    <ul class="">
                                        @foreach($page as $row)
                                        <li><a href="{{ route('page.view',$row->page_slug) }}">{{ $row->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets -->

            <div class="footer-info">
                <div class="container">
                    <div class="wrapper">
                        <div class="flexcol">
                            <div class="logo">
                                <a href=""><span class="circle"></span>.Store</a>
                            </div>
                            <div class="socials">
                                <ul class="flexitem">
                                    <li><a href="{{ $website->twitter }}"><i class="ri-twitter-line"></i></a></li>
                                    <li><a href="{{ $website->facebook }}"><i class="ri-facebook-line"></i></a></li>
                                    <li><a href="{{ $website->instagram }}"><i class="ri-instagram-line"></i></a></li>
                                    <li><a href="{{ $website->linkedin }}"><i class="ri-linkedin-line"></i></a></li>
                                    <li><a href="{{ $website->youtube }}"><i class="ri-youtube-line"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <p class="mini-text">Copyright 2022 © .Store. All right reseved.</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer -->

        <div class="menu-botton desktop-hide">
            <div class="container">
                <div class="wrapper">
                    <nav>
                        <ul class="flexitem">
                            <li>
                                <a href="#">
                                    <i class="ri-bar-chart-line"></i>
                                    <span>Trending</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="ri-user-6-line"></i>
                                    <span>Account</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('wishlist') }}">
                                    <i class="ri-heart-line"></i>
                                    <span>Wishlist</span>
                                </a>
                            </li>
                            <li>
                                <a href="#0" class="t-search">
                                    <i class="ri-search-line"></i>
                                    <span>Search</span>
                                </a>
                            </li>
                            <li>
                                <a href="#0" class="cart-trigger">
                                    <i class="ri-shopping-cart-line"></i>
                                    <span>Cart</span>
                                    <div class="fly-item">
                                        <span class="item-number">5</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Menu bottom -->

        <div class="search-bottom desktop-hide">
            <div class="container">
                <div class="wrapper">
                    <form class="search">
                        @csrf
                        <a href="#" class="t-close search-close flexcenter"><i class="ri-close-line"></i></a>
                        <span class="icon-large"><i class="ri-search-line"></i></span>
                        <input type="search" required placeholder="Search Your email address">
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Search bottom -->

        <div id="modal" class="modal">
            <div class="content flexcol">
                <div class="image" class="object-cover">
                    <img src="{{ asset('public/frontend') }}/assets/products/apparel4.jpg" alt="Not Found Image">
                </div>
                <h2>Get the letest deals and coupon</h2>
                <p class="mobile-hide">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maiores quibusdam neque magnam debitis corporis dolorum? Alias, magnam. Saepe laboriosam maiores fugit expedita suscipit non cupiditate, illum earum. Delectus, eaque ipsa.</p>
                <form action="{{ route('newsletter') }}" method="post" class="search" id="newsletter">
                    @csrf
                    <span class="icon-large"><i class="ri-mail-line"></i></span>
                    <input type="email" placeholder="Your email address" name="email" required>
                    <button type="submit">Subscribe</button>
                </form>
                <a href="#" class="mini-text">Do not show me this again</a>
                <a href="#" class="t-close modalclose flexcenter">
                    <i class="ri-close-line"></i>
                </a>
            </div>
        </div> 
        <!-- Modal -->

        <div class="overlay"></div> 
    </div>
    <!-- jQuery -->
    <script src="{{ asset('public/backend') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/swiper-bundle.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/fslightbox.js"></script>
    <!-- Summernote -->
    <script src="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!--Toastr js-->
    <script src="{{ asset('public/backend') }}/plugins/toastr/toastr.min.js"></script>
    <!-- sweetalert js -->
    <script src="{{ asset('public/backend') }}/plugins/sweetalert.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/script.js"></script>
    <script type="text/javascript">
        //summernote
        $(document).ready(function() {
          $('#summernote').summernote({
            height: 150,
          });
        });
       
    {{-- /* Toastr script */ --}}
    @if(Session::has('message'))
    toastr.options ={
      "progressBar" : true,
      "closeButton" : true,
    }
      var type="{{Session::get('alert-type','info')}}"
      switch(type){
      case 'info':
          toastr.info("{{ Session::get('message') }}");
          break;
      case 'success':
          toastr.success("{{ Session::get('message') }}");
          break;
      case 'warning':
          toastr.warning("{{ Session::get('message') }}");
          break;
      case 'error':
          toastr.error("{{ Session::get('message') }}");
          break;
      }
    @endif
    {{-- /*Logout Sweetalert script */ --}}
    $(document).on("click","#logout",function(e){
      e.preventDefault();
      var link = $(this).attr("href");
          swal({
              title: 'Are you Want to logout?',
              text: "",
              icon: 'warning',
              buttons: true,
              dangerMode:true,
          })
          .then((willDelete) => {
              if(willDelete){
                  window.location.href = link;
              }else{
                  swal("Not logout!");
              }
          });
      });
    //wishlist Count----
    function wishlist(){
        $.ajax({
           type:'get',
           url:'{{ route('count.wishlist') }}',
           dataType:'json',
           success:function(data){
            $('#wishlist_count').empty();
            $('#wishlist_count').append(data.wishlist_count);
           }
        });
    }
    $(document).ready(function(event){
        wishlist();
    });
    //compare count
    function compare(){
        $.ajax({
           type:'get',
           url:'{{ route('count.compare') }}',
           dataType:'json',
           success:function(data){
            $('#compare_count').empty();
            $('#compare_count').append(data.compare_count);
           }
        });
    }
    $(document).ready(function(event){
        compare();
    });
    //cart show----
    function cart(){
        $.ajax({
           type:'get',
           url:'{{ route('all.cart') }}',
           dataType:'json',
           success:function(data){
            $('.cart_qty').empty();
            $('.cart_total').empty();
            $('.cart_qty').append(data.cart_qty);
            $('.cart_total').append(data.cart_total);
           }
        });
    }
    $(document).ready(function(event){
        cart();
    });
    //cart remove with ajax----------
    $('body').on('click','.item-remove',function(){
      let id=$(this).data('id');
        $.ajax({
              url:'{{ url('/cartproduct-remove/') }}/'+id,
              type:'get',
            success:function(data){
                toastr.error(data);
                cart();
                location.reload();
            }
       });
    });
    // Submit Form & store-----------
    $('#newsletter_form').submit(function(e){
      e.preventDefault();
       var url = $(this).attr('action');
       var request = $(this).serialize();
      $.ajax({
          url:url,
          type:'post',
          async:false,
          data:request,
          success:function(data){
            if(data.error){
                toastr.error(data.error);
            }else{
                toastr.success(data.success);
            }
            $('#newsletter_form')[0].reset();
          }
        });
    });
    // Submit Form & store-----------
    $('#newsletter').submit(function(e){
      e.preventDefault();
       var url = $(this).attr('action');
       var request = $(this).serialize();
      $.ajax({
          url:url,
          type:'post',
          async:false,
          data:request,
          success:function(data){
            if(data.error){
                toastr.error(data.error);
            }else{
                toastr.success(data.success);
            }
            $('#newsletter')[0].reset();
            $('#modal').modal('hide');
          }
        });
    });
    </script>
    @stack('js')
</body>
</html>