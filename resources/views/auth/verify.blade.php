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
      <h1 class="h4 text-gray-900 mb-2">Masukkan password baru</h1>
    </div>
    <form class="user" action="{{route('confirm-reset')}}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{$token}}">
      <div class="form-group">
        <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" aria-describedby="emailHelp" value="{{Request::get('email')}}" placeholder="Enter Email Address..." required="" readonly="">
      </div>
      <div class="form-group">
        <input type="password" class="form-control form-control-user" id="exampleInputEmail" name="password" aria-describedby="emailHelp" placeholder="Password Baru" required="">
      </div>
      <div class="form-group">
        <input type="password" class="form-control form-control-user" id="exampleInputEmail" name="confirm_password" aria-describedby="emailHelp" placeholder="Ulangi Password Baru" required="">
      </div>
      <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
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
