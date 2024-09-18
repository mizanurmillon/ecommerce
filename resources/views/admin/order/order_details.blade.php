<form action="{{ route('order.update') }}" method="post" id="edit_form">
  @csrf
    <input type="hidden" class="form-control"  name="c_name" value="{{ $order->c_name }}"> 
    <input type="hidden" class="form-control"  name="c_phone" value="{{ $order->c_phone }}"> 
    <input type="hidden" class="form-control"  name="c_email" value="{{ $order->c_email }}"> 
    <input type="hidden" class="form-control" name="c_address" value="{{ $order->c_address }}"> 
    <input type="hidden" name="id" value="{{ $order->id }}">
  <div class="card">
    <div class="card-header">
      Customer Details
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-4">
          <strong>Name:</strong>{{ $order->c_name }}<br>
          <strong>Phone:</strong>{{ $order->c_phone }}<br>
          <strong>Email:</strong>{{ $order->c_email }}
        </div>
        <div class="col-lg-5">
          <strong>Address:</strong>{{ $order->c_address }}<br>
          <strong>Country:</strong>{{ $order->country }}<br>
          <strong>City:</strong>{{ $order->city }}<br>
          <strong>Zipcode:</strong>{{ $order->zip_code }}
        </div>
        <div class="col-lg-3">
          <strong>OrderId:</strong>{{ $order->order_id }}<br>
          <strong>Subtotal:</strong>{{ $order->subtotal }}<br>
          <strong>Total:</strong>{{ $order->total }}<br>
          <strong>Status:</strong>@if($order->status==0)
                      <span class="badge badge-danger">Order Pending</span>
                  @elseif($order->status==1)
                      <span class="badge badge-info">Order Recieved</span>
                  @elseif($order->status==2)
                      <span class="badge badge-primary">Order Shipped</span>
                  @elseif($order->status==3)
                      <span class="badge badge-success">Order Completed</span>
                  @elseif($order->status==4)
                      <span class="badge badge-warning">Order Return</span>
                  @elseif($order->status==5)
                    <span class="badge badge-danger">Order Cancel</span>
                  @endif
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      Order Details
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Color</th>
            <th scope="col">Size</th>
            <th scope="col">Quantity x Price</th>
            <th scope="col">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($order_details as $row)
          <tr>
            <th scope="row">{{ $row->product_name }}</th>
            <td>{{ $row->color }}</td>
            <td>{{ $row->size }}</td>
            <td>{{ $row->quantity }} x {{ $row->single_price }} ({{ $website->currency }})</td>
            <td>{{ $row->subtotal_price }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="form-group">
    <label for="status">Order Status<span class="text-danger">*</span></label>
    <select class="form-control" name="status">
	    <option value="0" @if($order->status==0) selected="" @endif>Order Pending</option>
	    <option value="1" @if($order->status==1) selected="" @endif>Order Recieved</option>
	    <option value="2" @if($order->status==2) selected="" @endif>Order Shipped</option>
	    <option value="3" @if($order->status==3) selected="" @endif>Order Completed</option>
	    <option value="4" @if($order->status==4) selected="" @endif>Order Return</option>
	    <option value="5" @if($order->status==5) selected="" @endif>Order Cancel</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success float-right"><span class="e_loader d-none">....</span>Update Status</button>
</form>
<script type="text/javascript">
  //Update Form Submit
    $('#edit_form').submit(function(e){
      e.preventDefault();
      $('.e_loader').removeClass('d-none');
      var url=$(this).attr('action');
      var request=$(this).serialize();
      $.ajax({
        url:url,
        type:'post',
        async:false,
        data:request,
        success:function(data){
          toastr.success(data);
          $('#edit_form')[0].reset();
          $('.e_loader').addClass('d-none');
          $('#ViewModal').modal('hide');
          $('.dataTable').DataTable().ajax.reload();
        }
      });
    });
</script>