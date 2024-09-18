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
            <h3 class="m-0 text-dark">Recieved Orders</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">All Recieved Orders</li>
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
            <h3 class="card-title">All Recieved Order list</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-lg-12">
                    <table id="" class="table table-sm table-bordered table-hover dataTable dtr-inline " role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr role="row">
                          <th>OrderId</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Subtotal({{ $website->currency }})</th>
                          <th>Total({{ $website->currency }})</th>
                          <th>PaymentType</th>
                          <th>Date</th>
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
    <!-- /.Edit Modal -->
    <div id="EditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-header bg-success"> 
                    <h4 class="modal-title">Edit Recieved Order Status</h4>
                     <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>  
                </div>
                <div class="modal-body" id="edit_part">
                  
                </div>
            </div> 
        </div>
      </div><!-- /.modal -->
      {{-- View Modal --}}
      <div id="ViewModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg"> 
            <div class="modal-content"> 
                <div class="modal-header bg-success"> 
                    <h4 class="modal-title">View Order Details</h4>
                     <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>  
                </div>
                <div id="view_modal_body" class="modal-body">
                  
                </div>
            </div> 
        </div>
      </div><!-- /.modal -->
  </div>
  @push('js')
  <script>
    //index data showing
    $(function order(){
      table=$('.dataTable').DataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('order.recieved') }}",
        columns:[
          {data:'order_id' , name:'order_id'},
          {data:'c_name' , name:'c_name'},
          {data:'c_phone' , name:'c_phone'},
          {data:'c_email' , name:'c_email'},
          {data:'subtotal' , name:'subtotal'},
          {data:'total' , name:'total'},
          {data:'payment_type' , name:'payment_type'},
          {data:'date' , name:'date'},
          {data:'status' , name:'status'},
          {data:'action' , name:'action' , orderable:true, searchable:true},
        ]
      });
    });
   //edit request send
    $('body').on('click','.edit',function(){
      var id=$(this).data('id');
      var url="{{ url('admin/order/edit') }}/"+id;
      $.ajax({
        url:url,
        type:'get',
        success:function(data){
          $('#edit_part').html(data);
        }
      })
    });
    //view order
    $('body').on('click','.view',function(){
      var id=$(this).data('id');
      var url="{{ url('admin/order/view') }}/"+id;
      $.ajax({
        url:url,
        type:'get',
        success:function(data){
          $('#view_modal_body').html(data);
        }
      })
    });
    //delete specific category
    $(document).ready(function(){
      $(document).on("click","#delete",function(e){
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
  </script>
  @endpush
@endsection
