<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use Illuminate\Http\Request;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

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
}
