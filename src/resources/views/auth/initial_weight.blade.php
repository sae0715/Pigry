@extends('layouts.auth')

@section('content')
<div class="card">
    <div class="logo">PiGLy</div>
    <div class="title">新規会員登録</div>
    <div class="step">STEP2 体重データの入力</div>

    <form action="/register/step2" method="POST">
        @csrf

        <div class="form-group">
            <label for="weight">現在の体重</label>
            <div class="input-with-unit">
                <input type="number" id="weight" name="weight" placeholder="現在の体重を入力" value="{{old('weight')}}">
                <span class="unit">kg</span>
            </div>
            @error('weight')
            <p class="error-message">{{$message}}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="target_weight">目標の体重</label>
            <div class="input-with-unit">
                <input type="number" id="target_weight" name="target_weight" placeholder="目標の体重を入力" value="{{old('target_weight')}}">
                <span class="unit">kg</span>
            </div>
            @error('target_weight')
            <p class="error-message">{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="btn-submit">アカウント作成</button>
    </form>

</div>
@endsection