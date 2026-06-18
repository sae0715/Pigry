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
            <td>{{ $weight_log->exercise_time }}</td>
            <td><a href="/weight_logs/{{ $weight_log->id }}">✏</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $weight_logs->links() }}
@endsection