@extends('layouts.app')

@section('content')

<div class="register-box">
  <div class="register-logo">
    <a href="/admin/login"><b>Find</b>Parking</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Registrase como administrador</p>

    <form method="POST" action="{{ route('admin.register') }}">
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
        <input id="administrator_first_name" type="text" class="form-control" placeholder="Nombres" name="administrator_first_name" value="{{ old('administrator_first_name') }}" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('administrator_first_name'))
            <span class="help-block">
                <strong>{{ $errors->first('administrator_first_name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input id="administrator_last_name" type="text" class="form-control" placeholder="Apellidos" name="administrator_last_name" value="{{ old('administrator_last_name') }}" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('administrator_last_name'))
            <span class="help-block">
                <strong>{{ $errors->first('administrator_last_name') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Contraseña">
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

    <a href="/admin/login" class="text-center">Ya tengo una cuenta</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
@endsection

