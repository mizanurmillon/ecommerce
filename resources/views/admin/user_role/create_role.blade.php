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
            <h3 class="m-0 text-dark">New User Role</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Add Role</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-success">
            <div class="card-header">
            <h3 class="card-title">Add new role</h3>
            </div>
            @if ($errors->any())
              <div class="alert alert-warning">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif 
            <form action="{{ route('store.role') }}" method="post">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-4">
                    <label>Employee Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Employee Name">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Employee Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter The Email">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <label>Category</label>
                    <input type="checkbox" name="category" value="1" checked="">
                  </div>
                  <div class="col-md-2">
                    <label>Product</label>
                    <input type="checkbox" name="product" value="1" checked="">
                  </div>
                  <div class="col-md-2">
                    <label>Client say</label>
                    <input type="checkbox" name="client_say" value="1" checked="">
                  </div>
                  <div class="col-md-2">
                    <label>Support Ticket</label>
                    <input type="checkbox" name="support_ticket" value="1" checked="">
                  </div>
                  <div class="col-md-2">
                    <label>Userrole</label>
                    <input type="checkbox" name="user_role" value="1" checked="">
                  </div>
                  <div class="col-md-2">
                    <label>Order</label>
                    <input type="checkbox" name="order" value="1" checked="">
                  </div>
                </div>
                 <div class="row">
                  <div class="col-md-2">
                    <label>Report</label>
                    <input type="checkbox" name="report" value="1" checked="">
                  </div>
                  <div class="col-md-2">
                    <label>Setting</label>
                    <input type="checkbox" name="setting" value="1" checked="">
                  </div>
                  <div class="col-md-2">
                    <label>Blog</label>
                    <input type="checkbox" name="blog" value="1" checked="">
                  </div>
                </div>
                <div class="input-group-append">
                 <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
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
