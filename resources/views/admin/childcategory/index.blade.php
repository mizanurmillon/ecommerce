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
            <h3 class="m-0 text-dark">Childcategory</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">All Childcategory</li>
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
             <button type="submit" class="btn btn-success btn-sm float-right"  data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add New</button>
            <h3 class="card-title">Childcategory List</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-lg-12">
                    <table id="" class="table table-sm table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr role="row">
                          <th >Sl</th>
                          <th >Category</th>
                          <th >Subcategory</th>
                          <th >Childcategory</th>
                          <th >Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr role="row">
                          
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr role="row">
                          <th >Sl</th>
                          <th >Category</th>
                          <th >Subcategory</th>
                          <th >Childcategory</th>
                          <th >Action</th>
                        </tr>
                      </tfoot>
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
  <!--Add Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h4 class="modal-title" id="exampleModalLabel">Childcategory Insert</h4>
        </div>
        <div class="modal-body">
         <form method="post" action="{{ route('childcategory.store') }}" id="add_form">
          @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Select Category/Subcategory<span class="text-danger">*</span></label>
              <select class="form-control" name="subcategory_id" id="subcategory_id">
                <option disabled="" selected="">Select category/subcategory</option>
                @foreach($category as $row)
                @php
                $subcategory=DB::table('subcategories')->where('category_id',$row->id)->get();
                @endphp
                <option class="text-danger" disabled="">{{ $row->category_name }}</option>
                    @foreach($subcategory as $row)
                    <option value="{{ $row->id }}">--{{ $row->subcategory_name }}</option>
                    @endforeach
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="childcategory">ChildCategory<span class="text-danger">*</span></label>
              <input type="text" name="childcategory_name" required class="form-control">
            </div>
            <button type="submit" class="btn btn-success float-right"><span class="loader d-none">....</span> Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- Edit Modal --}}
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h4 class="modal-title" id="exampleModalLabel">Childcategory Update</h4>
          
        </div>
        <div class="modal-body" id="edit_part">
         
        </div>
      </div>
    </div>
  </div>

  @push('js')
  <script type="text/javascript">
    //index data showing
    $(function childcategory(){
       table=$('.dataTable').dataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('child.category') }}",
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'category_name' , name:'category_name'},
          {data:'subcategory_name' , name:'subcategory_name'},
          {data:'childcategory_name' , name:'childcategory_name'},
          {data:'action' , name:'action'},
        ]
      });
    });
    //add Form Submit
     $('#add_form').submit(function(e){
      e.preventDefault();
      $('.loader').removeClass('d-none');
      var url=$(this).attr('action');
      var request=$(this).serialize();
      $.ajax({
        url:url,
        type:'post',
        async:false,
        data:request,
        success:function(data){
          toastr.success(data);
          $('#add_form')[0].reset();
          $('.loader').addClass('d-none');
          $('#addModal').modal('hide');
          $('.dataTable').DataTable().ajax.reload();
        }
      });
    });
    //edit request send
    $('body').on('click','.edit',function(){
      var id=$(this).data('id');
      var url="{{ url('admin/child-category/edit') }}/"+id;
      $.ajax({
        url:url,
        type:'get',
        success:function(data){
          $('#edit_part').html(data);
        }
      })
    });
    //delete specific category
    $(document).ready(function(){
      $(document).on("click","#childcategory_delete",function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $("#delete_form").attr('action',url);
        swal({
          title: 'Are you went to Delete?',
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
  </script>
  @endpush
@endsection
