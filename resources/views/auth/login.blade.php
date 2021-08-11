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
        <h1 class="h4 text-gray-900 mb-4">Halo, Selamat Datang!</h1>
      </div>
      <form id="form-login">
        @csrf
        <input type="hidden" name="next" value="{{Request::get('next')}}">
        <div class="form-group">
          <input type="text" class="form-control form-control-user " id="exampleInputEmail" aria-describedby="emailHelp" name="username" placeholder="Enter Email.." value="{{ old('username') }}" required autocomplete="off" autofocus>
                            </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                            </div>
        <div class="form-group">
          <div class="custom-control custom-checkbox small">
            <input type="checkbox" class="custom-control-input" id="cekpassword">
            <label id="cektext" class="custom-control-label" for="cekpassword">Show Password</label>
          </div>
        </div>
        <div class="form-group">
          <div class="custom-control custom-checkbox small">
            <input type="checkbox" class="custom-control-input" id="customCheck" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="custom-control-label" for="customCheck">Remember Me</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
       
      </form>
      <hr>
      <div class="text-center">
        <a class="small" href="{{route('register')}}">Create an Account!</a>
      </div>
      <div class="text-center">
        <a class="small" href="{{url('/')}}"><b>>> Back to Home</b></a>
      </div>
      <!-- <div class="text-center">
        <a class="small" href="{{route('reset')}}">Forgot Password?</a>
      </div>
    </div>
  </div>
@endsection
