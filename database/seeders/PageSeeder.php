<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\Page::create([

            'type' => 'sliders',
            'image' => '1.jpg',
            'link' => '#',

            'ar'=>[

                'title'=>'أفضل مجموعة من العروض تصل ل 50٪1',
                'short_description'=>'عروض 2023 بلاحدود',
            ],
            'en'=>[
                'title'=>' Best collection of offers up to 50% off',
                'short_description'=>'2023 offers without limits',
            ]
        ]);

        \App\Models\Page::create([

            'type' => 'sliders',
            'image' => '2.jpg',
            'link' => '#',

            'ar'=>[

                'title'=>'اخيارات متنوعة تخدم رغباتك ',
                'short_description'=>'عروض 2023 بلاحدود',
            ],
            'en'=>[
                'title'=>' Varied options to serve your desires',
                'short_description'=>'2023 offers without limits',
            ]
        ]);


        \App\Models\Page::create([

            'type' => 'sliderBoxs',
            'image' => '3.jpg',
            'link' => '#',

            'ar'=>[

                'title'=>'معدات ثقيلة ',
                'short_description'=>'عروض 2023 بلاحدود',
            ],
            'en'=>[
                'title'=>' Heavy Tools   ',
                'short_description'=>'2023 offers without limits',
            ]
        ]);

        \App\Models\Page::create([

            'type' => 'sliderBoxs',
            'image' => '4.jpg',
            'link' => '#',

            'ar'=>[

                'title'=>'عروض حصرية ',
                'short_description'=>'عروض 2023 بلاحدود',
            ],
            'en'=>[
                'title'=>'Exclusive offers   ',
                'short_description'=>'2023 offers without limits',
            ]
        ]);

        for ($i=0; $i <=3 ; $i++) {
            \App\Models\Page::create([
                'type' => 'offersHome',
                'image' => 5+$i.'.jpg',
                'link' => '#',

                'ar'=>[

                    'title'=>'عروض حصرية ',
                    'short_description'=>'علي كل اقسام ماكيتا	',
                ],
                'en'=>[
                    'title'=>'Exclusive offers   ',
                    'short_description'=>'  offers without limits  for makata'  ,
                ]
            ]);
        }


        \App\Models\Page::create([
            'type' => 'addLargHome',
            'image' => '8.jpg',
            'link' => '#',

            'ar'=>[

                'title'=>'عروض حصرية ',
                'short_description'=>'علي كل اقسام ماكيتا	',
            ],
            'en'=>[
                'title'=>'Exclusive offers   ',
                'short_description'=>'  offers without limits  for makata'  ,
            ]
        ]);
        \App\Models\Page::create([
            'type' => 'addSmallHome',
            'image' => '9.jpg',
            'link' => '#',

            'ar'=>[

                'title'=>'عروض حصرية ',
                'short_description'=>'علي كل اقسام ماكيتا	',
            ],
            'en'=>[
                'title'=>'Exclusive offers   ',
                'short_description'=>'  offers without limits  for makata'  ,
            ]
        ]);






    }
}
