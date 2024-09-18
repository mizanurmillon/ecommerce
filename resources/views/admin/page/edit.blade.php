<form action="{{ route('page.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="exampleInputEmail1">Title<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="title" value="{{ $data->title }}">
  </div>
  <div class="form-group">
    <label for="link">Link<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="link" name="link" value="{{ $data->link }}" readonly="">
  </div>
  <div class="form-group">
    <label>Page Position<span class="text-danger">*</span></label>
    <select class="form-control" name="page_position">
      <option value="1" @if($data->page_position==1) selected="" @endif>Line One</option>
      <option value="2" @if($data->page_position==2) selected="" @endif>Line Tow</option>
    </select>
  </div>
  <div class="form-group">
    <label for="content">Content<span class="text-danger">*</span></label>
    <textarea name="content" id="summernote" class="form-control">{{ $data->content }}</textarea>
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