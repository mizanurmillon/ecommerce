<form action="{{ route('childcategory.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="exampleInputEmail1">Select Category/Subcategory<span class="text-danger">*</span></label>
    <select class="form-control" name="subcategory_id" id="subcategory_id">
      <option disabled="" selected="">Select category/subcategory</option>
      @foreach($category as $row)
      @php
      $subcategory=DB::table('subcategories')->where('category_id',$row->id)->get();
      @endphp
      <option class="text-danger" disabled="">{{ $row->category_name }}</option>
          @foreach($subcategory as $row)
          <option value="{{ $row->id }}"@if($row->id==$data->subcategory_id) selected="" @endif>--{{ $row->subcategory_name }}</option>
          @endforeach
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="childcategory">ChildCategory<span class="text-danger">*</span></label>
    <input type="text" name="childcategory_name" value="{{ $data->childcategory_name }}" class="form-control">
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