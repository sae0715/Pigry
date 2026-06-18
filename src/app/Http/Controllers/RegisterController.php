<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\WeightTarget;
use App\Models\WeightLog;

class RegisterController extends Controller
{
    public function showStep1()
    {
        return view('auth.register');
    }

    public function storeStep1(RegisterStep1Request $request)
    {
        session([
            'register.name' => $request->name,
            'register.email' => $request->email,
            'register.password' => $request->password,
        ]);

        return redirect(
            '/register/step2'
        );
    }

    public function showStep2()
    {
        return view('auth.initial_weight');
    }

    public function storeStep2(RegisterStep2Request $request)
    {
        $user = User::create([
            'name' => session('register.name'),
            'email' => session('register.email'),
            'password' => Hash::make(session('register.password')),
        ]);

        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => $request->target_weight,
        ]);

        WeightLog::create([
            'user_id' => $user->id,
            'date' => today(),
            'weight' => $request->weight,
        ]);

        session()->forget('register');

        return redirect('/login');
    }
}
