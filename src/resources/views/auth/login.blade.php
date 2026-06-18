@extends('layouts.auth')

@section('content')
<div class="card">
    <div class="logo">PiGLy</div>
    <div class="title">ログイン</div>

    <form action="/login" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="text" id="email" name="email" placeholder="メールアドレスを入力" value="{{old('email')}}">
            @error('email')
            <p class="error-message">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" placeholder="パスワードを入力">
            @error('password')
            <p class="error-message">{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="btn-submit">ログイン</button>
    </form>

    <div class="auth-link">
        <a href="/register/step1">アカウント作成はこちら</a>
    </div>
</div>
@endsection