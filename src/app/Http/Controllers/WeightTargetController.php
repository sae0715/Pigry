<?php

namespace App\Http\Controllers;

use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WeightTargetRequest;

class WeightTargetController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $weight_target = WeightTarget::where('user_id', $user->id)->first();
        return view('weight_logs.goal_setting', compact('weight_target'));
    }

    public function update(WeightTargetRequest $request)
    {
        $user = Auth::user();
        $weight_target = WeightTarget::where('user_id', $user->id)->first();
        $weight_target->update([
            'target_weight' => $request->target_weight,
        ]);
        return redirect('/weight_logs');
    }
}
