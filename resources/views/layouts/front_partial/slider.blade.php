<div class="slider">
    <div class="container">
        <div class="wrapper">
            <div class="myslider swiper">
                <div class="swiper-wrapper">
                    @foreach($slider as $row)
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="image object-cover">
                                <img src="{{ asset('public/files/product/'.$row->thumbnail) }}" alt="Not found image">
                            </div>
                            <div class="text-content flexcol">
                                <h4>{{ $row->category_name }}</h4>
                                <h2><span>{{ $row->subcategory_name }}</span><br><span>{{  substr($row->product_name, 0, 25) }}..</span></h2>
                                <a href="{{ route('all.product') }}" class="primary-button">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</div>