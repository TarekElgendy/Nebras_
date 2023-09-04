<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    protected $model = Section::class;
    public function definition()
    {
        return [

            'image' => $this->faker->imageUrl(60,60),
            'ar'=>[
                'title'=>' طلب سعر تصنيع	',
                'description'=>$this->faker->sentence(),
            ],
            'en'=>[
                'title'=>'طلب سعر تصنيع	',
                'description'=>$this->faker->sentence(),
            ]
        ];
    }
}
