<?php 
$konfig = App\Models\Konfigurasi::first();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="{{url('image/konfigurasi/',$konfig->icon)}}">

  <title>{{$konfig->nama_portal}} - {{$judul}}</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('auth_login') }}/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="{{ asset('auth_login') }}/font.css??family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('auth_login') }}/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/custom/toast/jquery.toast.min.css">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              
              @yield('content')

            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('auth_login') }}/jquery/jquery.min.js"></script>
  <script src="{{ asset('auth_login') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('adminlte') }}/plugins/custom/toast/jquery.toast.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('auth_login') }}/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('auth_login') }}/sb-admin-2.min.js"></script>
{!!session('sukses')!!}
{!!session('gagal')!!}
<!-- Cek ulangi password -->
<script type="text/javascript">
  $('#exampleRepeatPassword').keyup(function() {
    valid = $('#valid')
    pass = $('#exampleInputPassword').val()
    xpass = $(this).val();
    if(pass != xpass){
      valid.attr('class','text-danger')
      valid.html('<br><i class="fa fa-times-circle"></i> Password tidak sama')
      $('#tombol').attr('class','btn btn-primary btn-user btn-block disabled')
      $('#tombol').attr('type','button')
    }else{
      valid.attr('class','text-success')
      valid.html('<br><i class="fa fa-check-circle"></i> Password sama')
      $('#tombol').attr('class','btn btn-primary btn-user btn-block')
      $('#tombol').attr('type','submit')
    }
  });
  $('#cekpassword').change(function(){
    pass = $('#exampleInputPassword')
    xpass = $('#exampleRepeatPassword')
    if($(this).is(':checked')){
      pass.attr('type','text')
      xpass.attr('type','text')
      $('#cektext').html('Hide Password')
    }else{
      pass.attr('type','password')
      xpass.attr('type','password')
      $('#cektext').html('Show Password')
    }
  })
</script>
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
<script>
  $('#form-login').submit(function(e){
    e.preventDefault();
    var form = new FormData(this);
    $.ajax({
      type: 'POST',
      url: '{{ route("login.api") }}',
      data: form,
      cache:false,
      contentType: false,
      processData: false,
      success: function(response) {
        console.log(response.status)
        if(response.status){
          let data = response.data; 
          localStorage.setItem('user',JSON.stringify(data))
          localStorage.setItem('jwt',response.token)
          window.location.href= '{{ url("/panel/dashboard") }}';
        }else{
          $('#exampleInputEmail').val('')
          $('#exampleInputPassword').val('')
          $('#exampleInputEmail').focus()
          $.toast({
                heading   : "Gagal",
                text    : response.message,
                showHideTransition : "slide",
                icon    : "warning",
                hideAfter   : false,
                position    : "bottom-right",
                bgColor   : "#FF4859"
              })
        }
      },
      error: function(xhr, status) {
        console.log(xhr)
        console.log(error)
      },
    })
  })
</script>
</body>

</html>
