<form action="{{ route('order.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="name">Customer Name</label>
    <input type="text" class="form-control" id="name" name="c_name" value="{{ $data->c_name }}">
  </div>
  <div class="form-group">
    <label for="phone">Customer Phone</label>
    <input type="text" id="phone" name="c_phone" class="form-control" value="{{ $data->c_phone }}">
  </div>
  <div class="form-group">
    <label for="email">Customer Email</label>
    <input type="email" id="email" name="c_email" class="form-control" value="{{ $data->c_email }}">
  </div>
  <div class="form-group">
    <label for="address">Customer Address</label>
    <input type="text" id="address" name="c_address" class="form-control" value="{{ $data->c_address }}">
  </div>
  <div class="form-group">
    <label for="status">Order Status<span class="text-danger">*</span></label>
    <select class="form-control" name="status">
	    <option value="0" @if($data->status==0) selected="" @endif>Order Pending</option>
	    <option value="1" @if($data->status==1) selected="" @endif>Order Recieved</option>
	    <option value="2" @if($data->status==2) selected="" @endif>Order Shipped</option>
	    <option value="3" @if($data->status==3) selected="" @endif>Order Completed</option>
	    <option value="4" @if($data->status==4) selected="" @endif>Order Return</option>
	    <option value="5" @if($data->status==5) selected="" @endif>Order Cancel</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success float-right"><span class="e_loader d-none">....</span>Update</button>
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
          $('#EditModal').modal('hide');
          $('.dataTable').DataTable().ajax.reload();
        }
      });
    });
</script>