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
            <h3 class="m-0 text-dark">User Role</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">All user role</li>
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
             <a href="{{ route('create.role') }}" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Add New</a>
            <h3 class="card-title">All User Role</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-lg-12">
                    <table id="" class="table table-sm table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr role="row">
                          <th >Sl</th>
                          <th >Name</th>
                          <th >Email</th>
                          <th >Role</th>
                          <th >Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $key=>$row)
                        <tr role="row">
                          <td>{{ $key+1 }}</td>
                          <td>{{ $row->name }}</td>
                          <td>{{ $row->email }}</td>
                          <td>
                            @if($row->category==1)<span class="badge badge-success">category</span>@endif
                            @if($row->product==1)<span class="badge badge-secondary">product</span>@endif
                            @if($row->client_say==1)<span class="badge badge-info">client_say</span>@endif
                            @if($row->support_ticket==1)<span class="badge badge-danger">support ticket</span>@endif
                            @if($row->user_role==1)<span class="badge badge-warning">userrole</span>@endif
                            @if($row->order==1)<span class="badge badge-success">order</span>@endif
                            @if($row->report==1)<span class="badge badge-dark">report</span>@endif
                            @if($row->setting==1)<span class="badge badge-danger">setting</span>@endif
                            @if($row->blog==1)<span class="badge badge-secondary">blog</span>@endif
                          </td>
                          <td>
                            <a href="#" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('role.delete',$row->id) }}" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        @endforeach
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
    <!-- /.content -->
  </div>
  @push('js')
  
  @endpush
@endsection
