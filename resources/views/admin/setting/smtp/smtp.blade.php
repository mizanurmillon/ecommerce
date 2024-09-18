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
            <h3 class="m-0 text-dark">SMTP Setting</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">SMTP Setting</li>
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
          <div class="col-md-8">
            <div class="card card-success">
            <div class="card-header">
            <h3 class="card-title">SMTP setting page</h3>
            </div>
            <form action="{{ route('smtp.update',$data->id) }}" method="post">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Type</label>
                  <select class="form-control" name="type">
                    <option value="Sendmail" @if($data->type=="Sendmail") selected="" @endif>Sendmail</option>
                    <option value="SMTP" @if($data->type=="SMTP") selected="" @endif>SMTP</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>MAIL HOST</label>
                  <input type="text" class="form-control" value="{{ $data->mail_host }}" name="mail_host">
                </div>
                <div class="form-group">
                  <label>MAIL PORT</label>
                  <input type="text" class="form-control" value="{{ $data->mail_port }}" name="mail_port">
                </div>
                <div class="form-group">
                  <label>MAIL USERNAME</label>
                  <input type="email" class="form-control" value="{{ $data->mail_username }}" name="mail_username">
                </div>
                <div class="form-group">
                  <label>MAIL PASSWORD</label>
                  <input type="text" class="form-control" value="{{ $data->mail_password }}" name="mail_password">
                </div>
                <div class="form-group">
                  <label>MAIL ENCRYPTION</label>
                  <input type="text" class="form-control" value="{{ $data->mail_encryption }}" name="mail_encryption">
                </div>
                <div class="form-group">
                  <label>MAIL FROM ADDRESS</label>
                  <input type="email" class="form-control" value="{{ $data->mail_from_address }}" name="mail_from_address">
                </div>
                <div class="form-group">
                  <label>MAIL FROM NAME</label>
                  <input type="text" class="form-control" value="{{ $data->mail_from_name }}" name="mail_from_name">
                </div>
                <div class="input-group-append">
                 <button type="submit" class="btn btn-success">Update</button>
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
