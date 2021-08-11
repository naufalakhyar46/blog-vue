<?php 
$konfig = App\Models\Konfigurasi::first();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$konfig->nama_dashboard}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="shortcut icon" href="{{url('image/konfigurasi/',$konfig->icon)}}">
  <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/skins/_all-skins.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/custom/toast/jquery.toast.min.css">
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/custom/summernote/summernote.css">
  <link href ="{{ asset('adminlte') }}/plugins/custom/lightbox/ekko-lightbox.css" rel = "stylesheet" >
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div id="app" class="wrapper">
  <!-- Left side column. contains the logo and sidebar -->
  
  <sidebar-component></sidebar-component>
  <menu-component></menu-component>
  <logout-component></logout-component>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      
    </section>
    <router-view></router-view>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    
    <strong>Copyright &copy; {{date('Y')}} <a href="javascript:void(0)">{{$konfig->nama_dashboard}}</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte') }}/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="{{ asset('adminlte') }}/bower_components/raphael/raphael.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('adminlte') }}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- DataTables -->
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- jvectormap -->
<script src="{{ asset('adminlte') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminlte') }}/bower_components/chart.js/chart.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminlte') }}/bower_components/moment/min/moment.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
   $('#calendar').datepicker({
        format:'mm/dd/yyyy',
    }).datepicker("setDate",'now');
</script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('adminlte') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/custom/toast/jquery.toast.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/custom/summernote/summernote.js"></script>
<script src="{{ asset('adminlte') }}/plugins/custom/form_element/form-elements.js"></script>
<script src="{{ asset('adminlte') }}/plugins/custom/jq.inview.js"></script>
  <script src = "{{ asset('adminlte') }}/plugins/custom/lightbox/ekko-lightbox.js"></script>
<!-- Select2 -->
<script src="{{ asset('adminlte') }}/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Slimscroll -->
<script src="{{ asset('adminlte') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte') }}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte') }}/dist/js/demo.js"></script>
<script src="{{ asset('js/app.js') }}"></script>

@yield('custom_js')
{!!session('sukses')!!}
{!!session('gagal')!!}
@if(session('errors'))
    @foreach ($errors->all() as $error)
    <script type="text/javascript">
                            $.toast({
                              heading   : "Gagal",
                              text    : "{{$error}}",
                              showHideTransition : "slide",
                              icon    : "warning",
                              hideAfter   : false,
                              position    : "bottom-right",
                              bgColor   : "#FF4859"
                            })
    </script>
    @endforeach
@endif

        <script type="text/javascript">
    function readURL(input,foto) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          foto.attr('src', e.target.result);
          foto.attr('href', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  function readURL2(input,foto) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          foto.attr('src', e.target.result);
          foto.attr('href', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
