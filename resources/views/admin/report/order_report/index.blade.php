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
            <h3 class="m-0 text-dark">Order Report</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Order Report</li>
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
            <h3 class="card-title">All Order Report</h3>
            <button type="submit" class="btn btn-primary btn-sm print" style="float: right;" title="Print"><span class="d-none loader">....</span><i class="fa-solid fa-print"></i></button>
          </div>

          <div class="row p-3">
            <div class="col-lg-4">
              <label>Payment Type</label>
              <select class="form-control submitable" name="payment_type" id="payment_type">
                <option value="">All</option>
                <option value="Hand Cash">Hend Cash</option>
                <option value="Aamerpay">Aamarpay</option>
                <option value="Paypal">Paypal</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label>Order Status</label>
              <select class="form-control submitable" name="status" id="status">
                <option value="">All</option>
                <option value="0">Order Pending</option>
                <option value="1">Order Recieved</option>
                <option value="2">Order Shipped</option>
                <option value="3">Order Completed</option>
                <option value="4">Order Return</option>
                <option value="5">Order Cancel</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label>Order Date</label>
              <input type="date" name="date" id="date" class="form-control submitable_input">
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
                          <th>OrderId</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Subtotal({{ $website->currency }})</th>
                          <th>Total({{ $website->currency }})</th>
                          <th>PaymentType</th>
                          <th>Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr role="row">
                          
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div> 
      </div>
        <!-- /.container-fluid -->
    </section>
  </div>
    <!-- /.content -->
  @push('js')
  <script>
    //index data showing
    $(function orderReport(){
      table=$('.dataTable').DataTable({
        "processing":true,
        "serverSide":true,
        "searching":true,
        "ajax":{
            "url":"{{ route('admin.order.index') }}",
            "data":function(e){
              e.payment_type=$("#payment_type").val();
              e.status=$("#status").val();
              e.date=$("#date").val();
            }
       },
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
        ]
      });
    });
    //submitable class call for every change
     $(document).on('change','.submitable',function(){
        $('.dataTable').DataTable().ajax.reload();
     });
     $(document).on('blur','.submitable_input',function(){
        $('.dataTable').DataTable().ajax.reload();
     });

     $('.print').on('click', function(e){
          e.preventDefault();
          $('.loader').removeClass('d-none');
           $.ajax({
              url:'{{ route('order.report.print') }}',
              data:{payment_type: $('#payment_type').val(),status: $('#status').val(),date: $('#date').val()},
              success:function(data){
                $('.loader').addClass('d-none');
                $(data).printThis({
                  debug:false,
                  importCSS:true,
                  importStyle:true,
                  importInline:true,
                  prinDelay:500,
                  header:null,
                  footer:null,
                });
              }

           });
        });
    
  </script>
  @endpush
@endsection
