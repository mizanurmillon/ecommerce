@extends('layouts.admin')
@section('admin_content')
@push('css')
@endpush
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="card content-header" style="padding: 10px;">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">New Products</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <form action="{{ route('product.store') }}" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header bg-dark">
                  <h3 class="card-title"><span><i class="fa fa-plus"></i></span> Add new products</h3>

                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                  @endif 
                </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-lg-12">
                        <label for="name">Product Name<span class="text-danger">*</span></label>
                        <input type="text" name="product_name" class="form-control" id="name" value="{{ old('product_name') }}" placeholder="product name">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-6">
                        <label for="code">Product Code<span class="text-danger">*</span></label>
                        <input type="text" name="product_code" class="form-control" id="code" value="{{ old('product_code') }}" placeholder="product code">
                      </div>
                      <div class="form-group col-lg-6">
                        <label>Category\Subcategory<span class="text-danger">*</span></label>
                        <select class="form-control" name="subcategory_id" id="subcategory_id">
                          <option disabled="" selected="">==chooes category==</option>
                          @foreach($category as $row)
                          @php
                          $subcategory=DB::table('subcategories')->where('category_id',$row->id)->get();
                          @endphp
                          <option class="text-danger" disabled="">{{ $row->category_name }}</option>
                              @foreach($subcategory as $row)
                              <option value="{{ $row->id }}">-- {{ $row->subcategory_name }}</option>
                              @endforeach
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-6">
                        <label>Brand<span class="text-danger">*</span></label>
                        <select class="form-control" name="brand_id">
                          @foreach($brand as $row)
                            <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-6">
                        <label>Pickup Point<span class="text-danger">*</span></label>
                        <select class="form-control" name="pickup_point_id">
                          @foreach($pickuppoint as $row)
                            <option value="{{ $row->id }}">{{ $row->pickup_point_name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-6">
                        <label>Warehouse<span class="text-danger">*</span></label>
                        <select class="form-control" name="warehouse_id">
                          @foreach($warehouse as $row)
                          <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-lg-6">
                        <label for="unit">Unit<span class="text-danger">*</span></label>
                        <input type="text" name="unit" class="form-control" id="unit" value="{{ old("unit") }}" placeholder="Unit (e.g. KG, Pc etc)">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-6">
                        <label for="tag">Tags</label>
                        <input type="text" name="tag" class="form-control" id="tags">
                        <ul id="demo-list"></ul>
                      </div>
                      <div class="form-group col-lg-6">
                        <label for="video">Video</label>
                        <input type="text" name="video" class="form-control" placeholder="Only embed code after embed work">
                        <small class="text-danger">(Only embed code after embed work)</small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-4">
                        <label for="purchase_price">Purchase Price<span class="text-danger">*</span></label>
                        <input type="text" name="purchase_price" class="form-control" id="purchase_price">
                      </div>
                      <div class="form-group col-lg-4">
                        <label for="selling_price">Selling Price<span class="text-danger">*</span></label>
                        <input type="text" name="selling_price" class="form-control" id="selling_price">
                      </div>
                      <div class="form-group col-lg-4">
                        <label for="discount">Discount Price</label>
                        <input type="text" name="discount_price" class="form-control" id="discount">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-6">
                        <label for="color">Color</label>
                        <input type="text" name="color" class="form-control" id="tags2">
                        <ul id="demo-list"></ul>
                      </div>
                      <div class="form-group col-lg-6">
                        <label for="size">Size</label>
                        <input type="text" name="size" class="form-control" id="tags3">
                        <ul id="demo-list"></ul>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-6">
                        <label for="stock_quantity">Stock Quantity<span class="text-danger">*</span></label>
                        <input type="number" name="stock_quantity" class="form-control" id="stock_quantity" min="1" value="1">
                      </div>
                      <div class="form-group col-lg-6">
                        <label for="stock">Stock<span class="text-danger">*</span></label>
                        <select class="form-control" name="stock_available">
                          <option value="1">Stock In</option>
                          <option value="0">Stock Out</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-12">
                        <label for="description">Product Description<span class="text-danger">*</span></label>
                        <textarea id="summernote" name="description" class="form-control"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="thumbnail">Thumbnail<span class="text-danger">*</span></label>
                      <input type="file" name="thumbnail" accept="image/*" class="dropify">
                    </div>
                    <div class="">
                      <table class="table table-bordered" id="dynamic_field">
                       <div class="card-header">
                          <h3 class="card-title" style="font-size:10px;">More Images (Click Add For More Image)</h3>
                        </div>
                        <tr>
                          <td><input type="file" accept="image/*" name="images[]" class="form-control name_list" style="border:none; outline:0;" /></td>
                          <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                        </tr>
                      </table>
                    </div>

                    <div class="card p-4">
                      <h6>Featured Product</h6>
                        <div class="form-group">
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked="" value="1" name="featured">
                            <label class="custom-control-label" for="customSwitch1"></label>
                          </div>
                        </div>
                    </div>
                     <div class="card p-4">
                      <h6>Trendy Product</h6>
                        <div class="form-group">
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input" id="customSwitch2" value="1" name="trendy">
                            <label class="custom-control-label" for="customSwitch2"></label>
                          </div>
                        </div>
                    </div>
                    <div class="card p-4">
                      <h6>Today Deal</h6>
                         <div class="form-group">
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" checked class="custom-control-input" id="customSwitch3" value="1" name="today_deal">
                            <label class="custom-control-label" for="customSwitch3"></label>
                          </div>
                        </div>
                    </div>
                    <div class="card p-4">
                      <h6>Status</h6>
                         <div class="form-group">
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" checked class="custom-control-input" id="customSwitch4" value="1" name="status">
                            <label class="custom-control-label" for="customSwitch4"></label>
                          </div>
                        </div>
                    </div>
                    <div class="card p-4">
                      <h6>Product Slider</h6>
                         <div class="form-group">
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input" id="customSwitch5" value="1" name="product_slider">
                            <label class="custom-control-label" for="customSwitch5"></label>
                          </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Add Product</button>
                  </div>
                </div>
              </div>

            </div>         
        </form>           
      </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @push('js')
  <script>
   // tags input
  $("#tags").tagsinput()
  $("#tags2").tagsinput()
  $("#tags3").tagsinput()

    // add image fild 
    $(document).ready(function(){
      var postURL="<?php echo url('addmore'); ?>";
      var i=1;

      $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" name="images[]" accept="image/*" class="form-control name_list"  style="border:none; outline:0;" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
      });
      $(document).on('click','.btn_remove',function(){
        var button_id=$(this).attr("id");
        $('#row'+button_id+'').remove();
      })
    });

    
    
  </script>
  @endpush
@endsection
 