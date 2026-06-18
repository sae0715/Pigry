@extends('layouts.app')

@section('content')
<div class="show-card">
    <h2>Weight Log</h2>

    <form action="/weight_logs/{{ $weightLog->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>日付</label>
            <input type="date" name="date" value="{{ $weightLog->date }}">
            @error('date')<p class="error-message">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label>体重</label>
            <div class="input-with-unit">
                <input type="number" name="weight" step="0.1" value="{{ $weightLog->weight }}">
                <span class="unit">kg</span>
            </div>
            @error('weight')<p class="error-message">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label>摂取カロリー</label>
            <div class="input-with-unit">
                <input type="number" name="calories" value="{{ $weightLog->calories }}">
                <span class="unit">cal</span>
            </div>
            @error('calories')<p class="error-message">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label>運動時間</label>
            <input type="time" name="exercise_time" value="{{ substr($weightLog->exercise_time, 0, 5) }}">
            @error('exercise_time')<p class="error-message">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label>運動内容</label>
            <textarea name="exercise_content">{{ $weightLog->exercise_content }}</textarea>
            @error('exercise_content')<p class="error-message">{{ $message }}</p>@enderror
        </div>

        <div class="btn-group">
            <a href="/weight_logs" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">更新</button>
        </div>
    </form>

    <form action="/weight_logs/{{ $weightLog->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">🗑</button>
    </form>
</div>
@endsection