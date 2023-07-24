@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Reset Password')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-cover">
  <div class="auth-inner row m-0">
    <!-- Brand logo-->
    {{-- <a class="brand-logo" href="#">
    </a> --}}
    <!-- /Brand logo-->

    <!-- Left Text-->
    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
        @if($configData['theme'] === 'dark')
         <img src="{{asset('images/login/nueva.svg')}}" class="img-fluid" alt="Register V2" style="max-width:75%" />
        @else
         <img src="{{asset('images/login/nueva.svg')}}" class="img-fluid" alt="Register V2" style="max-width:75%" />
        @endif
      </div>
    </div>
    <!-- /Left Text-->

    <!-- Reset password-->
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">

        <div class="text-center">
          <img src="{{ asset('images/login/pm2.png')}}" style="max-width:50%;padding-bottom:5px">
          <h2 class="card-title fw-bold mb-1">Nueva contraseña 🔒</h2>
          <p class="card-text mb-2">Su nueva contraseña debe ser diferente de las contraseñas utilizadas anteriormente</p>
        </div>

        <form class="auth-reset-password-form mt-2" action="/auth/login-cover" method="GET">
          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="reset-password-new">Nueva contraseña</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="reset-password-new" type="password" name="reset-password-new" placeholder="············" aria-describedby="reset-password-new" autofocus="" tabindex="1" />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="reset-password-confirm">Confirmar Contraseña</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="reset-password-confirm" type="password" name="reset-password-confirm" placeholder="············" aria-describedby="reset-password-confirm" tabindex="2" />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <button class="btn btn-primary w-100" tabindex="3">Guardar</button>
        </form>
        <p class="text-center mt-2">
          <a href="{{url('auth/login')}}">
            <i data-feather="chevron-left"></i>Volver al login
          </a>
        </p>
      </div>
    </div>
    <!-- /Reset password-->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/pages/auth-reset-password.js'))}}"></script>
@endsection
