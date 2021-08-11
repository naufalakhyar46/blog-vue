<?php 
$konfig = App\Models\Konfigurasi::first();
?>
@extends('layouts.akun.blueprint')
@section('content')
<div class="col-lg-6 d-none d-lg-block" style="
    background: url({{url('image/konfigurasi', $konfig->auth_image)}});
    background-position: center;
    background-size: cover;
"></div>
 <div class="col-lg-6">
  <div class="p-5">
    <div class="text-center">
      <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
      <p class="mb-4">Kami mengerti, banyak hal terjadi. Cukup masukkan alamat email Anda di bawah ini dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda!</p>
    </div>
    <form class="user" action="{{route('reset')}}" method="post">
      @csrf
      <div class="form-group">
        <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." required="">
      </div>
      <button type="submit" class="btn btn-primary btn-user btn-block">Kirim Tautan</button>
    </form>
    <hr>
    <div class="text-center">
      <a class="small" href="{{route('register')}}">Create an Account!</a>
    </div>
    <div class="text-center">
      <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
    </div>
    <div class="text-center">
        <a class="small" href="{{url('/')}}"><b>>> Back to Home</b></a>
      </div>
  </div>
</div>
@endsection
