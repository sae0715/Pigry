<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $baseWeight;

    public function __construct(...$args)
    {
        parent::__construct(...$args);
        //基準体重の設定
        $this->baseWeight = $this->faker->randomFloat(1, 45, 100);
    }


    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'weight' => round($this->baseWeight + $this->faker->randomFloat(1, -0.8, 1.0), 1),
            'calories' => $this->faker->numberBetween(1000, 3000),
            'exercise_time' => $this->faker->time('H:i:s'),
            'exercise_content' => implode('、', $this->faker->randomElements([
                'ウォーキング',
                'ジョギング',
                '筋トレ',
                'ヨガ',
                '水泳',
                'サイクリング',
                'ストレッチ',
                '縄跳び',
                'エアロビクス',
                'ピラティス',
                'マシントレーニング',
            ], $this->faker->numberBetween(1, 5))),
        ];
    }
}
