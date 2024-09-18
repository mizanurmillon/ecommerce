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
            <h3 class="m-0 text-dark">View Ticket</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Ticket Reply</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="card ">
          <div class="card-header card-info">
            <h4>Your Ticket Details.</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                  <strong>User Name: <span class="text-muted">{{ $ticket->name }}</span></strong><br>
                  <strong>Subject: <span class="text-muted">{{ $ticket->subject }}</span></strong><br>
                  <strong>Service: <span class="text-muted">{{ $ticket->service }}</span></strong><br>
                  <strong>Prortity: <span class="text-muted">{{ $ticket->prortity }}</span></strong><br>
                  <strong>Message: <span class="text-muted">{{ $ticket->message }}</span></strong>
              </div>
              <div class="col-md-4">
                  <a href="{{ asset('public/files/ticket/'.$ticket->image) }}" target="_blank"><img src="{{ asset('public/files/ticket/'.$ticket->image) }}" alt="" style="height: 100px; width: 100px;"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
          <div class="row">
            <div class="col-lg-5">
              <div class="card">
                <div class="card-header bg-dark">
                  <h3 class="card-title">Reply Ticket Message</h3>
                </div>
                <form action="{{ route('admin.store.reply') }}" method="post" accept-charset="utf-8"  enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-lg-12">
                        <label for="message">Message<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="message" id="message" required></textarea>
                      </div>
                      <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                      <div class="form-group col-lg-12">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success"></i>Send</button>
                  </div>
                </form> 
              </div>
              <a href="{{ route('close.ticket',$ticket->id) }}" class="btn btn-danger" style="float: right;">Close Ticket</a>
            </div>
            {{-- All replies message show --}}
            @php
            $replies=DB::table('replies')->where('ticket_id',$ticket->id)->orderBy('id','DESC')->get();
            @endphp
            <div class="col-lg-7">
              <div class="card">
                <div class="card-header bg-dark">
                  <h4>All Reply Message.</h4>
                </div>
                <div class="card-body" style="height: 400px; overflow-y: scroll;">
                  @isset($replies)
                  @foreach($replies as $row)
                    <div class="card mt-2 @if($row->user_id==0) ml-5 @endif">
                      <div class="card-header @if($row->user_id==0) bg-success @else bg-danger @endif">
                        <i class="fa-solid fa-user"></i> @if($row->user_id==0)Admin @else{{ $ticket->name }}@endif
                      </div>
                      <div class="card-body">
                          <p>{{ $row->message }}</p>
                          <footer class="blockquote-footer">{{ date('d F Y',strtotime($row->reply_date)) }}</footer>
                      </div>
                    </div>
                    @endforeach
                    @endisset
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
 