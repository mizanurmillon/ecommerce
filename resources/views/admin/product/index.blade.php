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
            <h3 class="m-0 text-dark">Product</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">All Products</li>
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
        <div class="card">
          <div class="card-header bg-dark">
             <a href="{{ route('create.product') }}" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Add Product</a>
            <h3 class="card-title">All products list</h3>
          </div>

          <div class="row p-3">
            <div class="col-lg-4">
              <label>category</label>
              <select class="form-control submitable" name="category_id" id="category_id">
                <option value="">All</option>
                @foreach($category as $row)
                  <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-lg-4">
              <label>Brand</label>
              <select class="form-control submitable" name="brand_id" id="brand_id">
                <option value="">All</option>
                @foreach($brand as $row)
                  <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-lg-4">
              <label>WareHouse</label>
              <select class="form-control submitable" name="warehouse_id" id="warehouse_id">
                <option value="">All</option>
                @foreach($warehouse as $row)
                  <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                @endforeach
              </select>
            </div>
            
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-lg-12">
                    <table id="" class="table table-sm table-bordered table-hover dataTable dtr-inline " role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr role="row">
                          <th>Sl</th>
                          <th>Thumbnail</th>
                          <th>Name</th>
                          <th>Code</th>
                          <th>Category</th>
                          <th>Subcategory</th>
                          <th>Brand</th>
                          <th>Featured</th>
                          <th>Today Deal</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr role="row">
                          
                        </tr>
                      </tbody>
                      
                    </table>
                    <form id="delete_form" action="" method="post">
                      @method('DELETE')
                      @csrf
                    </form>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div> 
      </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @push('js')
  <script>
    //index data showing
    $(function product(){
      table=$('.dataTable').DataTable({
        "processing":true,
        "serverSide":true,
        "searching":true,
        "ajax":{
            "url":"{{ route('product.manage') }}",
            "data":function(e){
              e.category_id=$("#category_id").val();
              e.brand_id=$("#brand_id").val();
              e.warehouse_id=$("#warehouse_id").val();
              e.status=$("#status").val();
            }
       },
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'thumbnail' , name:'thumbnail'},
          {data:'product_name' , name:'product_name'},
          {data:'product_code' , name:'product_code'},
          {data:'category_name' , name:'category_name'},
          {data:'subcategory_name' , name:'subcategory_name'},
          {data:'brand_name' , name:'brand_name'},
          {data:'featured' , name:'featured'},
          {data:'today_deal' , name:'today_deal'},
          {data:'status' , name:'status'},
          {data:'action' , name:'action' , orderable:true, searchable:true},
        ]
      });
    });
   
    //delete specific category
    $(document).ready(function(){
      $(document).on("click","#product_delete",function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $("#delete_form").attr('action',url);
        swal({
          title: 'Are you went to deleted product?',
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: 'warning',
          buttons: true,
          dangerMode:true,
        })
        .then((willDelete)=>{
          if (willDelete){
             $("#delete_form").submit();
          }else{
            swal('Safe Data!')
          }
        });
      });
      //Data passed through here
      $("#delete_form").submit(function(e){
        e.preventDefault();
         var url = $(this).attr('action');
         var request = $(this).serialize();
         $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
              toastr.error(data);
              $('#delete_form')[0].reset();
              $('.dataTable').DataTable().ajax.reload();
            }
         });
      });
    });

    //submitable class call for every change
     $(document).on('change','.submitable',function(){
        $('.dataTable').DataTable().ajax.reload();
     });
    
  </script>
  @endpush
@endsection
 