@extends('layouts.app')
    {{-- @section('navbar')
       @include('layouts.front_partial.collaps_nav')    
    @endsection --}}
@section('content')
@push('css')
@endpush
<div class="single-cart">
    <div class="container">
        <div class="wrapper">
            <div class="breadcrumb">
                <ul class="flexitem">
                    <li><a href="#">Home</a></li>
                    <li>Cart</li>
                </ul>
            </div>
            <div class="cart-title">
                <h2>Shopping Cart</h2>
            </div>
            <div class="products one cart">
                <div class="flexwrap">
                    <form action="" class="form-cart">
                        <div class="item">
                            <table id="cart-table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($content as $row)
                                 @php
                                    $product=DB::table('products')->where('id',$row->id)->first();
                                    $colors=explode(',',$product->color);
                                    $sizes=explode(',',$product->size);
                                 @endphp
                                    <tr>
                                        <td class="flexitem">
                                            <div class="thumbnall object-cover">
                                                <a href="#"><img src="{{ asset('public/files/product/'.$row->options->thumbnail) }}" alt="Not Found Image"></a>
                                            </div>
                                            <div class="content">
                                                <strong><a href="#">{{ $row->name }}</a></strong>
                                                <p>
                                                   @if($row->options->color !=NULL)
                                                    Color
                                                   @endif
                                                   @if($row->options->size !=NULL)
                                                    / Size:
                                                   @endif
                                                </p>
                                               @if($row->options->color !=NULL)
                                                <select name="color" id="color" class="color" data-id="{{ $row->rowId }}" style="padding: 10px 15px;">
                                                   @foreach($colors as $color)
                                                   <option value="{{ $color }}" @if($color==$row->options->color) selected="" @endif>{{ $color }}</option>
                                                   @endforeach
                                                </select>
                                                @endif
                                                @if($row->options->size !=NULL)
                                                <select name="size" id="size" class="size" data-id="{{ $row->rowId }}" style="padding: 10px 15px;">
                                                   @foreach($sizes as $size)
                                                   <option value="{{ $size }}" @if($size==$row->options->size) selected="" @endif>{{ $size }}</option>
                                                   @endforeach
                                                </select>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $website->currency }}{{ $row->price }}</td>
                                        <td>
                                            <div class="qty-control flexitem">
                                                <button class="minus" data-action="minus" type="button">-</button>
                                                <input type="text" class="qty" name="qty" value="{{ $row->qty }}" data-id="{{ $row->rowId }}" min="1">
                                                <button class="plus" data-action="add" type="button">+</button>
                                            </div>
                                        </td>
                                        <td>{{ $website->currency }}{{ $row->price * $row->qty }}</td>
                                        <td><a href="javascript:void(0)" data-id="{{ $row->rowId }}" class="item-remove"><i class="ri-close-line"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="cart-summary styled">
                        <div class="item">
                            <div class="cart-total">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td>{{ $website->currency }}{{ Cart::subtotal() }}</td>
                                        </tr>
                                        <tr class="grand-total">
                                            <td>TOTAL</td>
                                            <td><strong>{{ $website->currency }}{{ Cart::total() }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="{{ route('chackout') }}" class="secondary-button">Chackout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
<script type="text/javascript">
   // Color Update with ajax---
   $('body').on('change','.color',function(){
      let color=$(this).val();
      let rowId=$(this).data('id');
         $.ajax({
          url:'{{ url('update-color/') }}/'+rowId+'/'+color,
          type:'get',
          async:false,
          success:function(data){
            toastr.success(data);
          }
       });
   });
   // Color Update with ajax---
   $('body').on('change','.size',function(){
      let size=$(this).val();
      let rowId=$(this).data('id');
         $.ajax({
          url:'{{ url('update-size/') }}/'+rowId+'/'+size,
          type:'get',
          async:false,
          success:function(data){
            toastr.success(data);
          }
       });
   });
   //Qty update with ajax-----
   $('body').on('blur','.qty',function(){
      let qty=$(this).val();
      let rowId=$(this).data('id');
         $.ajax({
          url:'{{ url('update-qty/') }}/'+rowId+'/'+qty,
          type:'get',
          async:false,
          success:function(data){
            toastr.success(data);
            location.reload();
          }

       });
   });
</script>
@endpush
@endsection