<form action="{{ route('warehouse.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="name">Warehouse Name<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="name" name="warehouse_name" value="{{ $data->warehouse_name }}">
  </div>
  <div class="form-group">
    <label for="address">Warehouse Address<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="address" name="warehouse_address" value="{{ $data->warehouse_address}}">
  </div>
  <div class="form-group">
    <label for="phone">Warehouse Phone<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="phone" name="warehouse_phone" value="{{ $data->warehouse_phone }}">
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