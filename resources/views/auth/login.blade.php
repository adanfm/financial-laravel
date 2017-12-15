@extends('layouts.admin')

@section('content')
    <div class="container" id="login-panel">
        <div class="row">
            <div class="col s6 offset-s3 z-depth-2">
                <h3 class="center"> Code Financeiro Admin</h3>
                <form method="POST" action="{{ url(env('URL_ADMIN_LOGIN')) }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="input-field col s12">
                            <?php $messageError = $errors->has('email') ? "data-error='{$errors->first('email')}'" : null;?>
                            <input id="email" type="email" class="validate {{ $messageError? 'invalid' : $messageError  }}" name="email" value="{{ old('email') }}" required autofocus>
                            <label for="email" {!! $messageError !!}>E-Mail</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <?php $messageError = $errors->has('password') ? "data-error='{$errors->first('password')}'" : null;?>
                                <input id="password" type="password" class="validate {{ $messageError? 'invalid' : $messageError  }}" name="password" required>
                            <label for="email" {!! $messageError !!}>Senhal</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : ''}}>
                            <label for="remember">Lembrar-me</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn">Logar</button>
                            <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                Esqueceu sua senha ?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
