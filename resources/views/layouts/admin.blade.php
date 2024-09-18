<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/fontawesome-free/css/all.min.css">
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/daterangepicker/daterangepicker.css">
  <!-- datatables  -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.css">
  {{-- Dropify image --}}
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/dropify.css">
  {{-- tagsinput.css --}}
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/tagsinput/bootstrap-tagsinput.css">
  <!-- Toastr css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">
    .table-hover tbody tr:hover {
      color: #ebf0f4 !important;
      background-color: #252B48!important;
    }
    .table-bordered{
      border: 1px solid #060606;
    }
    .table-bordered td, .table-bordered th {
      border: 1px solid #0d0f11;
    }
    .table thead th {
      vertical-align: bottom;
      border-bottom: 1px solid #0b0c0d;
    }
  </style>
  @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @guest

  @else
<div class="wrapper">

  @include('layouts.admin_partial.navbar')

  <!-- Main Sidebar Container -->
  @include('layouts.admin_partial.sidebar')
 @endguest

  <!-- Content Wrapper. Contains page content -->
   @yield('admin_content')
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ asset('public/backend') }}/plugins/jquery/jquery.min.js"></script>
{{-- bootstrap switch --}}
<script src="{{ asset('public/backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('public/backend') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('public/backend') }}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('public/backend') }}/plugins/sparklines/sparkline.js"></script>
<!--Toastr js-->
<script src="{{ asset('public/backend') }}/plugins/toastr/toastr.min.js"></script>
<!-- sweetalert js -->
<script src="{{ asset('public/backend') }}/plugins/sweetalert.min.js"></script>
<!-- JQVMap -->
<script src="{{ asset('public/backend') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('public/backend') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('public/backend') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('public/backend') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('public/backend') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/backend') }}/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('public/backend') }}/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/backend') }}/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="{{ asset('public/backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

{{-- tagsinput --}}
<script src="{{ asset('public/backend') }}/plugins/tagsinput/bootstrap-tagsinput.js"></script>

{{-- Dropify image --}}
<script src="{{ asset('public/backend') }}/plugins/dropify.min.js"></script>
{{-- PrintThis js --}}
<script src="{{ asset('public/backend') }}/plugins/printThis.min.js"></script>
<script>


  // switch
   $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state',$(this).prop('checked'));
    });

  //Dropify image
    $('.dropify').dropify();
    
    //summernote
    $(document).ready(function() {
      $('#summernote').summernote({
        height: 150,
      });
    });
    
    //DataTable
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
    {{-- /* Toastr script */ --}}
    @if(Session::has('message'))
    toastr.options ={
      "progressBar" : true,
      "closeButton" : true,
    }
      var type="{{Session::get('alert-type','info')}}"
      switch(type){
      case 'info':
          toastr.info("{{ Session::get('message') }}");
          break;
      case 'success':
          toastr.success("{{ Session::get('message') }}");
          break;
      case 'warning':
          toastr.warning("{{ Session::get('message') }}");
          break;
      case 'error':
          toastr.error("{{ Session::get('message') }}");
          break;
      }
    @endif

    {{-- /*Logout Sweetalert script */ --}}
    $(document).on("click","#logout",function(e){
      e.preventDefault();
      var link = $(this).attr("href");
          swal({
              title: 'Are you Want to logout?',
              text: "",
              icon: 'warning',
              buttons: true,
              dangerMode:true,
          })
          .then((willDelete) => {
              if(willDelete){
                  window.location.href = link;
              }else{
                  swal("Not logout!");
              }
          });
      });
     // delete sweetalert script
     $(document).on("click","#delete",function(e){
      e.preventDefault();
      var link = $(this).attr("href");
          swal({
              title: 'Are you went to Delete?',
              text: "Once Delete , This will be Permanently Delete!",
              icon: 'warning',
              buttons: true,
              dangerMode:true,
          })
          .then((willDelete) => {
              if(willDelete){
                  window.location.href = link;
              }else{
                  swal("Safe Data!");
              }
          });
      });
</script>
@stack('js')
</body>
</html>
