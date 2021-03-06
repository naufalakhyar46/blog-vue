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

  <title>{{$konfig->nama_portal}} </title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('auth_login') }}/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="{{ asset('auth_login') }}/font.css??family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('auth_login') }}/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/custom/toast/jquery.toast.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

</head>

<body class="bg-gradient-primary">

  <div id="app" class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block" style="
                    background: url({{url('image/konfigurasi', $konfig->auth_image)}});
                    background-position: center;
                    background-size: cover;
                "></div>
              {{-- konten --}}
              <router-view></router-view>

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
<script src="{{ asset('js/app.js') }}"></script>


</body>

</html>
