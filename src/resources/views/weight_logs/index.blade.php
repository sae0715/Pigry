@extends('layouts.app')

@section('content')
<div class="summary">
    <div class="summary_item">
        <p class="summary_title">目標体重</p>
        <p class="summary_weight">{{$weight_target->target_weight}}kg</p>
    </div>

    <div class="summary_item">
        <p class="summary_title">目標まで</p>
        <p class="summary_weight">{{$weight_target->target_weight - $latest_weight->weight}}kg</p>
    </div>

    <div class="summary_item">
        <p class="summary_title">最新体重</p>
        <p class="summary_weight">{{$latest_weight->weight}}kg</p>
    </div>
</div>

<div id="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); align-items:center; justify-content:center; z-index:1000;">
    <div style="background:white; padding:40px; border-radius:8px; width:500px;">
        <h2>Weight Logを追加</h2>
        <form action="/weight_logs" method="POST">
            @csrf
            <div class="form-group">
                <label>日付<span class="required-badge">必須</span></label>
                <input type="date" name="date" value="{{ date('Y-m-d') }}">
                @error('date')<p class="error-message">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label>体重<span class="required-badge">必須</span></label>
                <input type="number" name="weight" step="any" value="{{ old('weight') }}">
                @error('weight')<p class=" error-message">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label>摂取カロリー<span class="required-badge">必須</span></label>
                <input type="number" name="calories" value="{{ old('calories') }}">
                @error('calories')<p class=" error-message">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label>運動時間<span class="required-badge">必須</span></label>
                <input type="time" name="exercise_time" value="{{ old('exercise_time') }}">
                @error('exercise_time')<p class="error-message">{{ $message }}</p>@enderror
            </div>
            <div class=" form-group">
                <label>運動内容</label>
                <textarea name="exercise_content">{{ old('exercise_content') }}</textarea>
                @error('exercise_content')<p class="error-message">{{ $message }}</p>@enderror
            </div>
            <div class="btn-group">
                <a href="/weight_logs" class="btn-back">戻る</a>
                <button type="submit" class="btn-submit">登録</button>
            </div>
        </form>
    </div>
</div>

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('modal').style.display = 'flex';
    });
</script>
@endif

<div class="index-card">
    <div class="search-bar">
        <form action="/weight_logs/search" method="GET" class="search-form">
            <input type="date" name="from" value="{{ $from ?? '' }}">
            <span>〜</span>
            <input type="date" name="to" value="{{ $to ?? '' }}">
            <button type="submit" class="btn-search">検索</button>
            @if(isset($from) || isset($to))
            <a href="/weight_logs" class="btn-reset">リセット</a>
            @endif
        </form>
        <button onclick="document.getElementById('modal').style.display='flex'" class="btn-add">データ追加</button>
    </div>

    @if(isset($from) || isset($to))
    <p class="search-result">{{ $from ? \Carbon\Carbon::parse($from)->format('Y年n月j日') : '' }}〜{{ $to ? \Carbon\Carbon::parse($to)->format('Y年n月j日') : '' }}の検索結果 {{ $weight_logs->total() }}件</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>食事摂取カロリー</th>
                <th>運動時間</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($weight_logs as $weight_log)
            <tr>
                <td>{{ str_replace('-', '/', $weight_log->date) }}</td>
                <td>{{ $weight_log->weight }}kg</td>
                <td>{{ $weight_log->calories }}cal</td>
                <td>{{ substr($weight_log->exercise_time, 0, 5) }}</td>
                <td><a href="/weight_logs/{{ $weight_log->id }}"><i class="fas fa-pencil-alt"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="display:flex; justify-content:center; margin-top:24px;">
        {{ $weight_logs->links() }}
    </div>
</div>

@endsection