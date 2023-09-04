<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Section::create([

            'ar'=>[
                'title'=>'السشكن الاساسي',
                'description'=>'وصف بالعربي ',
            ],
            'en'=>[
                'title'=>'Main Section',
                'description'=>"Des English ",
            ]
        ]);

    }
}
