@extends('layouts.auth')

@section('content')
<div class="card">
    <div class="logo">PiGLy</div>
    <div class="title">新規会員登録</div>
    <div class="step">STEP1 アカウント情報の登録</div>

    <form action="/register/step1" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">お名前</label>
            <input type="text" id="name" name="name" placeholder="お名前を入力" value="{{old('name')}}">
            @error('name')
            <p class="error-message">{{$message}}</p>
            @enderror
        </div>

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

        <button type="submit" class="btn-submit">次に進む</button>
    </form>

    <div class="auth-link">
        <a href="/login">ログインはこちら</a>
    </div>
</div>
@endsection