@extends('layouts.app')
{{-- @include('layouts.front_partial.collaps_nav') --}}
@section('content')
@push('css')
@endpush
<style type="text/css">
    @media screen and (min-width: 768px) {
    .profile.one .left {
        flex: 0 0 49%;
        width: 49%;
    }
    .profile.one .right {
        flex: 0 0 49%;
        width: 49%;
    }
}
</style>
<div class="featured">
    <div class="container">
        <div class="wrapper">
            <div class="column">
                <div class="sectop flexitem">
                    <h2><span class="circle"></span><span>{{ $page->title }}</span></h2>
                </div>
            </div>
            @if($page->page_slug == "contact-us")
            <div class="profile one">
                <div class="flexwrap">
                   <div class="left">
                        <div class="item">
                            <div class="shop__fl__body">
                                <div class="list-group">
                                    {!! $page->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item right">
                        <div class="products main flexwrap">
                            <form action="#" method="post" id="contactForm">
                                @csrf
                                <p>
                                    <label for="name">Name:<span></span></label>
                                    <input type="text" id="name" name="name" placeholder="Enter The Name" style="width: 550px;" >
                                    <span style="color: red; font-size: 10px; text-transform: uppercase;"></span>
                                </p>
                                <p>
                                    <label for="phone">Number:<span></span></label>
                                    <input type="text" id="phone" name="phone" placeholder="Enter Your Phone" style="width: 550px;">
                                   <span style="color: red; font-size: 10px; text-transform: uppercase;"></span>
                                </p>
                                <p>
                                    <label for="email">Email Address:<span></span></label>
                                    <input type="email" id="email" placeholder="Enter The Email" autocomplete="off" name="email" style="width: 550px;">
                                    <span style="color: red; font-size: 10px; text-transform: uppercase;"></span>
                                </p>
                                <p>
                                    <label for="subject">Subject:<span></span></label>
                                    <input type="text" id="subject" name="subject" style="width: 550px;">
                                   <span style="color: red; font-size: 10px; text-transform: uppercase;"></span>
                                </p>
                                <p>
                                    <label for="message">Message:</label>
                                    <textarea name="message" id="message" cols="15" rows="5" style="line-height: 18px; width: 550px;"></textarea>
                                </p>
                                <div class="primary-checkout">
                                    <button class="primary-button" id="submit_button" type="submit">Contact Us</button>
                                </div>
                            </form>
                        </div>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
            @else
            <div class="products main flexwrap">
                <p>{!! $page->content !!}</p>
            </div>
            @endif
            <br>
            <br>
        </div>
        
    </div>
</div>


@push('js')
<script type="text/javascript">
   $('#contactForm').submit(function(e){
      e.preventDefault();
      $.ajax({
        url:'{{ route("send.contact") }}',
        type:'post',
        data:$(this).serializeArray(),
        dataType:'json',
        success:function(response){
          if(response.status == true){
            toastr.success(response.success);
            window.location.href='{{ route("page.view",$page->page_slug) }}';
          }else{
            var errors = response.errors;
            if(errors.name){
                $('#name').addClass('is-invalid').siblings('span').addClass('invalid-feedback').html(errors.name);
            }else{
                $('#name').removeClass('is-invalid').siblings('span').removeClass('invalid-feedback').html('');
            }
            if(errors.phone){
                $('#phone').addClass('is-invalid').siblings('span').addClass('invalid-feedback').html(errors.phone);
            }else{
                $('#phone').removeClass('is-invalid').siblings('span').removeClass('invalid-feedback').html('');
            }
            if(errors.email){
                $('#email').addClass('is-invalid').siblings('span').addClass('invalid-feedback').html(errors.email);
            }else{
                $('#email').removeClass('is-invalid').siblings('span').removeClass('invalid-feedback').html('');
            }
            if(errors.subject){
                $('#subject').addClass('is-invalid').siblings('span').addClass('invalid-feedback').html(errors.subject);
            }else{
                $('#subject').removeClass('is-invalid').siblings('span').removeClass('invalid-feedback').html('');
            }
          }
        }
      });
    });
</script>
@endpush
@endsection