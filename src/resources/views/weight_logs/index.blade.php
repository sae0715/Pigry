@extends('layouts.app')

@section('content')
<div class="summary">
    <div class="summary_item">
        <p class="summary_title">目標体重</p>
        <p class="summary_weight">{{$weight_target->target_weight}}.kg</p>
    </div>

    <div class="summary_item">
        <p class="summary_title">目標まで</p>
        <p class="summary_weight">{{$weight_target->target_weight - $latest_weight->weight}}.kg</p>
    </div>

    <div class="summary_item">
        <p class="summary_title">最新体重</p>
        <p class="summary_weight">{{$latest_weight->weight}}.kg</p>
    </div>
</div>

<button onclick="document.getElementById('modal').style.display='flex'" class="btn-submit">データ追加</button>

<div id="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); align-items:center; justify-content:center; z-index:1000;">
    <div style="background:white; padding:40px; border-radius:8px; width:500px;">
        <h2>Weight Logを追加</h2>
        <form action="/weight_logs" method="POST">
            @csrf
            <div class="form-group">
                <label>日付</label>
                <input type="date" name="date" value="{{ date('Y-m-d') }}">
                @error('date')<p class="error-message">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label>体重</label>
                <input type="number" name="weight" step="0.1">
                @error('weight')<p class="error-message">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label>摂取カロリー</label>
                <input type="number" name="calories">
                @error('calories')<p class="error-message">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label>運動時間</label>
                <input type="time" name="exercise_time">
                @error('exercise_time')<p class="error-message">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
                <label>運動内容</label>
                <textarea name="exercise_content"></textarea>
                @error('exercise_content')<p class="error-message">{{ $message }}</p>@enderror
            </div>
            <button type="button" onclick="document.getElementById('modal').style.display='none'">戻る</button>
            <button type="submit" class="btn-submit">登録</button>
        </form>
    </div>
</div>

<form action="/weight_logs/search" method="GET">
    <input type="date" name="from" value="{{ $from ?? '' }}">
    <span>〜</span>
    <input type="date" name="to" value="{{ $to ?? '' }}">
    <button type="submit">検索</button>
    <a href="/weight_logs">リセット</a>
</form>

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
            <td>{{ $weight_log->date }}</td>
            <td>{{ $weight_log->weight }}</td>
            <td>{{ $weight_log->calories }}</td>
            <td>{{ substr($weight_log->exercise_time, 0, 5) }}</td>
            <td><a href="/weight_logs/{{ $weight_log->id }}">✏</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $weight_logs->links() }}
@endsection