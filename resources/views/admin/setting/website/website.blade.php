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
            <h3 class="m-0 text-dark">Website Setting</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Wabsite Setting</li>
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
            <h3 class="card-title">Wabsite setting page</h3>
            </div>
            <form action="{{ route('update.website',$website->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6" style="border-right: 1px solid #DDD;">
                    <div class="form-group">
                      <label>Currency</label>
                      <select class="form-control" name="currency">
                        <option value="$" @if($website->currency=="$") selected="" @endif>Dollar($)</option>
                        <option value="৳" @if($website->currency=="৳") selected="" @endif>Taka(৳)</option>
                        <option value="€" @if($website->currency=="€") selected="" @endif>Euro(€)</option>
                        <option value="₹" @if($website->currency=="₹") selected="" @endif>Rupee(₹)</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Language</label>
                      <select class="form-control" name="language">
                        <option value="Bangla" @if($website->language=="Bangla") selected="" @endif>Bangla</option>
                        <option value="English" @if($website->language=="English") selected="" @endif>English</option>
                        <option value="Arabic" @if($website->language=="Arabic") selected="" @endif>Arabic</option>
                        <option value="French" @if($website->language=="French") selected="" @endif>French</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Phone One</label>
                      <input type="text" class="form-control" value="{{ $website->phone_one }}" name="phone_one">
                    </div>
                    <div class="form-group">
                      <label>Phone Tow</label>
                      <input type="text" class="form-control" value="{{ $website->phone_tow }}" name="phone_tow">
                    </div>
                    <div class="form-group">
                      <label>Main Email</label>
                      <input type="email" class="form-control" value="{{ $website->main_email }}" name="main_email">
                    </div>
                    <div class="form-group">
                      <label>Support Email</label>
                      <input type="email" class="form-control" value="{{ $website->support_email }}" name="support_email">
                    </div>
                    <div class="form-group">
                      <label>Logo</label>
                      <input type="file" class="dropify" name="logo" data-default-file="{{ asset('public/files/logo/'.$website->logo) }}" data-height="100"/>
                      <input type="hidden" name="old_image" value="{{ $website->logo }}">
                    </div>
                   
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Favicon</label>
                      <input type="file" class="dropify" name="favicon" data-default-file="{{ asset('public/files/logo/'.$website->favicon) }}" data-height="100"/>
                      <input type="hidden" name="old_favicon" value="{{ $website->favicon }}">
                    </div>
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control" value="{{ $website->address }}" name="address">
                    </div>
                    <div class="form-group">
                      <label>Facebook</label>
                      <input type="text" class="form-control" value="{{ $website->facebook }}" name="facebook">
                    </div>
                    <div class="form-group">
                      <label>Twitter</label>
                      <input type="text" class="form-control" value="{{ $website->twitter }}" name="twitter">
                    </div>
                    <div class="form-group">
                      <label>Linkedin</label>
                      <input type="text" class="form-control" value="{{ $website->linkedin }}" name="linkedin">
                    </div>
                    <div class="form-group">
                      <label>Instagram</label>
                      <input type="text" class="form-control" value="{{ $website->instagram }}" name="instagram">
                    </div>
                    <div class="form-group">
                      <label>Youtube</label>
                      <input type="text" class="form-control" value="{{ $website->youtube }}" name="youtube">
                    </div>
                  </div>
                </div>
                <div class="input-group-append">
                  <button type="submit" class="btn btn-warning">Update</button>
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
