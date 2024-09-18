@extends('layouts.app')
        
@section('content')
{{-- @include('layouts.front_partial.collaps_nav') --}}
@push('css')
@endpush
<style type="text/css">
    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }
    .mt-2, .my-2 {
        margin-top: .5rem!important;
    }
    .card-header {
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(0,0,0,.03);
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .bg-success{
        background-color:#28a745;
    }
    .bg-danger{
        background-color: #dc3545;
    }
    .ml-4{
        margin-left: 40px;
    }
</style>
 <div class="single-profile">
    <div class="container">
        <div class="wrapper">
            <div class="column">
                <div class="profile one">
                    <div class="flexwrap">
                        @include('customer.sidebar')
                        <div class="item right" style="margin-top: 30px; margin-bottom: 20px; padding:10px; border: 1px solid #DDD;">
                            <div>
                                <h3>Your Ticket Detalis:</h3><hr>
                                <strong>Subject: {{ $view_ticket->subject }}</strong><br>
                                <strong>Service: {{ $view_ticket->service }}</strong><br>
                                <strong>Prortity: {{ $view_ticket->prortity }}</strong><br>
                                <strong>Message: {{ $view_ticket->message }}</strong><br>
                            </div>
                            <div>
                                <a target="_blank" href="{{ asset('public/files/ticket/'.$view_ticket->image) }}">
                                    <img src="{{ asset('public/files/ticket/'.$view_ticket->image) }}" style="height: 120px; width:150px;">
                                </a>
                            </div>
                            <br>
                            <hr>
                            <br>
                            {{-- All reply message show --}}
                            @php
                            $replies=DB::table('replies')->where('ticket_id',$view_ticket->id)->orderBy('id','DESC')->get();
                            @endphp
                            <div>
                                <h3>All Reply Message.</h3>
                               <div class="card-body" style="height: 400px; overflow-y: scroll;">
                                @isset($replies)
                                    @foreach($replies as $row)
                                    <div class="card mt-2 @if($row->user_id==0) ml-4 @endif">
                                      <div class="card-header @if($row->user_id==0) bg-success @else bg-danger @endif">
                                        <i class="ri-user-fill"></i>@if($row->user_id==0) Admin @else {{ Auth::user()->name }} @endif
                                      </div>
                                      <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                          <p>{{ $row->message }}</p>
                                          <br>
                                          <footer class="blockquote-footer">--- <cite title="Source Title">{{ date('d F Y'),strtotime($row->reply_date) }}</cite></footer>
                                        </blockquote>
                                      </div>
                                    </div>
                                    @endforeach
                                 @endisset   
                               </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <strong>Reply Message.</strong>
                            <br>
                            <br>
                            <form action="{{ route('reply.ticket') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <p>
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" cols="10" rows="2" style="line-height: 18px"></textarea>
                                </p>
                                <input type="hidden" name="ticket_id" value="{{ $view_ticket->id }}">
                                <p>
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image">
                                </p>
                                <div class="primary-checkout">
                                    <button class="primary-button" type="submit">Reply Ticket</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>
@push('js')
@endpush
@endsection

