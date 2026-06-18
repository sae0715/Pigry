@extends('layouts.app')

@section('content')
<div class="show-card">
    <h2>目標体重設定</h2>

    <form action="/weight_logs/goal_setting" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <div class="input-with-unit">
                <input type="number" name="target_weight" step="0.1" value="{{ $weight_target->target_weight }}">
                <span class="unit">kg</span>
            </div>
            @error('target_weight')<p class="error-message">{{ $message }}</p>@enderror
        </div>

        <div class="btn-group">
            <a href="/weight_logs" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">更新</button>
        </div>
    </form>
</div>
@endsection