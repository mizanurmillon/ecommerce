<div class="dpt-menu">
    <ul class="second-links">
        @foreach($category as $row)

        @php
        $subcategory=DB::table('subcategories')->where('category_id',$row->id)->get();
        @endphp
        <li class="has-child @if($row->category_name=='Beauty') beauty @elseif($row->category_name=="Electronic") electronic @elseif($row->category_name=='Womens Fashion') women-fashion @endif">
            <a href="{{ route('categorywise.product',$row->id) }}">
                <div class="icon-large"><img src="{{ asset('public/files/category/'.$row->image) }}" alt="Not Found Image" style="width: 25px; height:25px "></div>
                {{ $row->category_name }}
                <div class="icon-small"><i class="ri-arrow-right-s-line"></i></div>
            </a>
            <ul>
                @foreach($subcategory as $row)
                <li><a href="{{ route('subcategorywise.product',$row->id) }}">{{ $row->subcategory_name }}</a></li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
</div>