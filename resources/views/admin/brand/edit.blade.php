<link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/dropify.css">
<form action="{{ route('brand.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="exampleInputEmail1">Brand Name<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="brand_name" required value="{{ $data->brand_name }}">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Status</label>
    <select class="form-control" name="status">
      <option value="1" @if($data->status==1) selected="" @endif>Active</option>
      <option value="0" @if($data->status==0) selected="" @endif>Deactive</option>
    </select>
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Logo<span class="text-danger">*</span></label>
    <input type="file" class="dropify" name="brand_logo" data-default-file="{{ asset('public/files/brand/'.$data->brand_logo) }}"/>
    <input type="hidden" name="old_brand_logo" value="{{ $data->brand_logo }}">
  </div>
  <button type="submit" class="btn btn-success float-right submit_button"><span class="loader d-none">....</span> Update</button>
</form>
<script src="{{ asset('public/backend') }}/plugins/dropify.min.js"></script>
<script type="text/javascript">
  //Update Form Submit
   $('#edit_form').submit(function(e){
      e.preventDefault();
      $('.loading_button').removeClass('d-none');
      var url=$(this).attr('action');
      var request=$(this).serialize();
      $('.submit_button').prop('type','button');
      $.ajax({
        url:url,
        type:'post',
        data:new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
          toastr.success(data);
          $('#edit_form')[0].reset();
          $('.loading_button').hide();
          $('.submit_button').prop('type','submit');
          $('.dataTable').DataTable().ajax.reload();
          $('#editModal').modal('hide');
          $(".dropify-clear").trigger("click");
        }
      });
    });
    //Dropify image
    $('.dropify').dropify();
</script>