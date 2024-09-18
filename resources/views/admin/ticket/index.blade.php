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
            <h3 class="m-0 text-dark">Support Ticket</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">All Ticket</li>
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
            <h3 class="card-title">All Ticket list</h3>
          </div>

          <div class="row p-3">
            <div class="col-lg-4">
              <label>Ticket Services</label>
              <select class="form-control submitable" name="service" id="service">
                <option value="">All</option>
                 <option value="Technicel">Technicel</option>
                  <option value="Payment">Payment</option>
                  <option value="Affiliate">Affiliate</option>
                  <option value="Return">Return</option>
                  <option value="Refund">Refund</option>
              </select>
            </div>

            <div class="col-lg-4">
              <label>Status</label>
              <select class="form-control submitable" name="status" id="status">
                <option value="">All</option>
                <option value="0">Pending</option>
                <option value="1">Replied</option>
                <option value="2">Close</option>
              </select>
            </div>

            <div class="col-lg-4">
              <label>Date</label>
                <input type="date" name="date" class="form-control submitable_input" id="date">
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
                          <th>Date</th>
                          <th>User Name</th>
                          <th>Subject</th>
                          <th>Service</th>
                          <th>Priortity</th>
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
    $(function ticket(){
      table=$('.dataTable').DataTable({
        "processing":true,
        "serverSide":true,
        "searching":true,
        "ajax":{
            "url":"{{ route('index.ticket') }}",
            "data":function(e){
              e.service=$("#service").val();
              e.date=$("#date").val();
              e.status=$("#status").val();
            }
       },
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'date' , name:'date'},
          {data:'name' , name:'name'},
          {data:'subject' , name:'subject'},
          {data:'service' , name:'service'},
          {data:'prortity' , name:'prortity'},
          {data:'status' , name:'status'},
          {data:'action' , name:'action' , orderable:true, searchable:true},
        ]
      });
    });
   
    //delete specific category
    $(document).ready(function(){
      $(document).on("click","#delete",function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $("#delete_form").attr('action',url);
        swal({
          title: 'Are you went to deleted Ticket?',
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
     $(document).on('blur','.submitable_input',function(){
        $('.dataTable').DataTable().ajax.reload();
     });
    
  </script>
  @endpush
@endsection
 