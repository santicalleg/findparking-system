@extends('layouts.app')

@section('content')

<div class="register-box">
  <div class="register-logo">
    <a href="/login"><b>Find</b>Parking</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Registrase como usuario</p>

    <form method="POST" action="{{ route('register') }}">
      {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input id="name" type="text" class="form-control" placeholder="Usuario" name="name" value="{{ old('name') }}" required autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
         @if ($errors->has('name'))
             <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
             </span>
         @endif
      </div>
      <div class="form-group has-feedback">
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
             <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
             </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input id="first_name" type="text" class="form-control" placeholder="Primer Nombre" name="first_name" value="{{ old('first_name') }}" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('first_name'))
            <span class="help-block">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input id="last_name" type="text" class="form-control" placeholder="Segundo Nombre" name="last_name" value="{{ old('last_name') }}" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('last_name'))
            <span class="help-block">
                <strong>{{ $errors->first('last_name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input id="mobile_number" type="text" class="form-control" placeholder="Celular" name="mobile_number" value="{{ old('mobile_number') }}" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('mobile_number'))
            <span class="help-block">
                <strong>{{ $errors->first('mobile_number') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        {{-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div> --}}
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarse</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    {{-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div> --}}

    <a href="/login" class="text-center">Ya tengo una cuenta</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
@endsection
