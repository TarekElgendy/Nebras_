<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([
            'num1' => '0114510038',
            'num2' => '0114510038',
            'email' => 'nebrastools@gmail.com',

            'ar'=>[

                'title'=>'نبراس للعدد والمعدات الصناعية  ',
                'address'=>'مكان المشروع',
            ],
            'en'=>[
                'title'=>'Nebras for tools and industrial equipment ',

                'address'=>'address English',
            ]
        ]);






    }
}
