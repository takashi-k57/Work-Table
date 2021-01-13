@extends('layouts.app_admin')

@section('content')
<div class="signinPage">
  <div class="container">
    <div class ="log" style="width: 160px; height: 160px; margin: 0 auto;">
     <img src="/logo_transparent2.png" class="log-image" style="object-fit: contain; wigth: 100%; height: 100%;">
    </div>
    <h2 class="title" style="text-align: center">管理者ログイン</h2>
    <div class="text-center m-3">or</div>
    <div class="text-center">
      <p class="acountPage_link"><a href="{{ route('admin.register') }}">アカウントを作成</a></p>
    </div>
    <form class="new_user" id="new_user" action="{{ route('admin.login') }}" accept-charset="UTF-8" method="post">
     @csrf
      <div class="form-group">
        <label for="user_email">メールアドレス</label><br>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group">
        <label for="user_password">パスワード</label><br>
        <input id="password" type="password" class="form-control" name="password" required>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group text-center">
        <input type="submit" name="commit" value="ログインする" class="loginBtn" data-disable-with="ログインする">
      </div>
    </form>
  </div>
</div>
@endsection
