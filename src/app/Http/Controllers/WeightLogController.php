<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use Illuminate\Http\Request;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WeightLogRequest;

class WeightLogController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $latest_weight = WeightLog::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->first();
        $weight_logs = WeightLog::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->paginate(8);
        $weight_target = WeightTarget::where('user_id', $user->id)
            ->first();

        return view('weight_logs.index', compact('latest_weight', 'weight_logs', 'weight_target'));
    }

    public function create()
    {
        $user = Auth::user();

        $latest_weight = WeightLog::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->first();
        $weight_logs = WeightLog::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->paginate(8);
        $weight_target = WeightTarget::where('user_id', $user->id)
            ->first();

        return view('weight_logs.index', compact('latest_weight', 'weight_logs', 'weight_target'));
    }

    public function store(WeightLogRequest $request)
    {
        $user = Auth::user();

        WeightLog::create([
            'user_id' => $user->id,
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect('/weight_logs');
    }

    public function search(Request $request)
    {
        $user = Auth::user();

        $from = $request->from;
        $to = $request->to;

        $query = WeightLog::where('user_id', $user->id);

        if ($from) {
            $query->where('date', '>=', $from);
        }
        if ($to) {
            $query->where('date', '<=', $to);
        }

        $weight_logs = $query->orderBy('date', 'desc')->paginate(8)->appends(request()->query());

        $latest_weight = WeightLog::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->first();

        $weight_target = WeightTarget::where('user_id', $user->id)
            ->first();

        return view('weight_logs.index', compact('latest_weight', 'weight_logs', 'weight_target', 'from', 'to'));
    }

    public function show(WeightLog $weightLog)
    {
        return view('weight_logs.show', compact('weightLog'));
    }

    public function update(WeightLogRequest $request, WeightLog $weightLog)
    {
        $weightLog->update([
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect('/weight_logs');
    }

    public function destroy(WeightLog $weightLog)
    {
        $weightLog->delete();
        return redirect('/weight_logs');
    }
}
