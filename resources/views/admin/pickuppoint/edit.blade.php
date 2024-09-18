<form action="{{ route('pickuppoint.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="name">Pickup Point Name<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="name" name="pickup_point_name" required value="{{ $data->pickup_point_name }}">
  </div>
  <div class="form-group">
    <label for="address">Pickup Point Address<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="address" name="pickup_point_address" required value="{{ $data->pickup_point_address }}">
  </div>
  <div class="form-group">
    <label for="phone">Pickup Point Phone<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="phone" name="pickup_point_phone" required value="{{ $data->pickup_point_phone }}">
  </div>
  <div class="form-group">
    <label for="name">Pickup Point Phone Two<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="name" name="pickup_point_phone_two" required value="{{ $data->pickup_point_phone_two }}">
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
          $('#editModal').modal('hide');
          $('.dataTable').DataTable().ajax.reload();
        }
      });
    });
</script>