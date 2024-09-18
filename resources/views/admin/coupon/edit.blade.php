<form action="{{ route('coupon.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="coupon">Coupon Code<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="coupon" name="coupon_code" required value="{{ $data->coupon_code }}">
  </div>
  <div class="form-group">
    <label for="type">Coupon Type<span class="text-danger">*</span></label>
    <select class="form-control" name="type">
      <option value="1" @if($data->type==1) selected="" @endif>Fixed</option>
      <option value="2" @if($data->type==2) selected="" @endif>Precentge</option>
    </select>
  </div>
  <div class="form-group">
    <label for="type">Coupon Amount<span class="text-danger">*</span></label>
    <input type="text" name="coupon_amount" class="form-control" required value="{{ $data->coupon_amount }}">
  </div>
  <div class="form-group">
    <label for="type">Valid Date<span class="text-danger">*</span></label>
    <input type="date" name="valid_date" class="form-control" required value="{{ $data->valid_date }}">
  </div>
  <div class="form-group">
    <label for="status">Status<span class="text-danger">*</span></label>
    <select class="form-control" name="status">
      <option value="Active" @if($data->status=="Active") selected="" @endif>Active</option>
      <option value="Inactive" @if($data->status=="Inactive") selected="" @endif>Inactive</option>
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
          $('#editModal').modal('hide');
          $('.dataTable').DataTable().ajax.reload();
        }
      });
    });
</script>