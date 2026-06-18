<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        WeightLog::factory(35)->create(['user_id' => $user->id]);

        // 最新体重を取得
        $latestWeight = WeightLog::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->first()
            ->weight;

        // 目標体重 = 最新体重より5〜15kg低く設定
        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => round($latestWeight - rand(5, 15), 1),
        ]);
    }
}
