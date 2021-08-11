<?php 
$konfig = App\Models\Konfigurasi::first();
?>
@extends('layouts.akun.blueprint')

@section('content')
<div class="col-lg-5 d-none d-lg-block" style="
    background: url({{url('image/konfigurasi', $konfig->auth_image)}});
    background-position: center;
    background-size: cover;
"></div>
<div class="col-lg-7">
    <div class="p-5">
      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
      </div>
      <form class="user" action="{{route('register')}}" method="post">
        @csrf
        <div class="form-group ">
            <input type="text" class="form-control form-control-user" id="exampleFirstName" name="name" placeholder="Full Name" value="{{ old('name') }}" required="">
        </div>
        <div class="form-group">
          <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" placeholder="Email Address" value="{{ old('email') }}" required="">
                            </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password" required="">
          </div>
          <div class="col-sm-6">
            <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" name="confirm_password" placeholder="Repeat Password" required="">
          </div>
                              <div class="col-md-12">
            <div id="valid">
              
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="custom-control custom-checkbox small">
            <input type="checkbox" class="custom-control-input" id="cekpassword">
            <label id="cektext" class="custom-control-label" for="cekpassword">Show Password</label>
          </div>
        </div>
            <button type="submit" id="tombol" class="btn btn-primary btn-user btn-block disabled">Register Account</button>
      </form>
      <hr>
      {{-- <div class="text-center">
        <a class="small" href="{{route('reset')}}">Forgot Password?</a>
      </div> --}}
      <div class="text-center">
        <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
      </div>
      <div class="text-center">
        <a class="small" href="{{url('/')}}"><b>>> Back to Home</b></a>
      </div>
    </div>
  </div>
@endsection
