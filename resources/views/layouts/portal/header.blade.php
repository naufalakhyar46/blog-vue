<?php 
  $konfig = App\Models\Konfigurasi::first();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{$konfig->nama_portal}} - {{$title}}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{url('image/konfigurasi',$konfig->icon)}}" rel="icon">
  <link href="{{url('image/konfigurasi',$konfig->icon)}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('portal') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('portal') }}/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="{{ asset('portal') }}/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="{{ asset('portal') }}/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="{{ asset('portal') }}/assets/vendor/nivo-slider/css/nivo-slider.css" rel="stylesheet">
  <link href="{{ asset('portal') }}/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="{{ asset('portal') }}/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="{{ asset('portal') }}/assets/slick/slick.css" rel="stylesheet">
  <link href="{{ asset('portal') }}/assets/slick/slick-theme.css" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="{{ asset('portal') }}/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eBusiness - v2.2.1
  * Template URL: https://bootstrapmade.com/ebusiness-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body data-spy="scroll" data-target="#navbar-example">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="{{url('/')}}"><span>{{substr($konfig->nama_portal,0,1)}}</span>{{substr($konfig->nama_portal,1)}}</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          @if(Request::segment(1) == null)
          <li><a href="#header">Home</a></li>
          <li><a href="#blog">Blog</a></li>
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#contact">Kontak</a></li>
          @else
          <li><a href="{{url('/')}}#header">Home</a></li>
          <li><a href="{{url('/')}}#blog">Blog</a></li>
          <li><a href="{{url('/')}}#about">Tentang Kami</a></li>
          <li><a href="{{url('/')}}#contact">Kontak</a></li>
          @endif
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

