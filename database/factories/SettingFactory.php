<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    protected $model = Setting::class;
    public function definition()
    {
        return [
            'num1' => $this->faker->phoneNumber,
            'email' => $this->faker->email(),
            'logo' => $this->faker->imageUrl(60,60),
            'icon' => $this->faker->imageUrl(60,60),
            'ar'=>[
                'title'=>$this->faker->sentence(),
                'address'=>$this->faker->sentence(),
            ],
            'en'=>[
                'title'=>$this->faker->sentence(),
                'address'=>$this->faker->sentence(),
            ]
        ];
    }
}
