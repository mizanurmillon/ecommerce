<form action="{{ route('category.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="exampleInputEmail1">Category Name<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="category_name" required value="{{ $data->category_name }}">
    <small id="emailHelp" class="form-text text-muted">This is your main category</small>
  </div>
  <div class="form-group">
    <label id="image">Image</label>
    <input type="file" name="image" class="dropify" data-default-file="{{ asset('public/files/category/'.$data->image) }}">
    <input type="hidden" name="old_image" value="{{ $data->image }}">
  </div>
  <button type="submit" class="btn btn-success float-right"><span class="e_loader d-none">....</span>Update</button>
</form>
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