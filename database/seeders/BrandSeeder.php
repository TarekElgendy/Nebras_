<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for ($i=0; $i <=5 ; $i++) {
       \App\Models\Brand::create([

            'image'=>$i+1 .'.webp',
            'ar'=>[
                'title'=>'براند ' .$i+1,
                'description'=>'وصف ' .$i+1,

            ],
            'en'=>[
                'title'=>'Brand ' .$i+1,
                'description'=>'Desc Brand ' .$i+1,

            ]
        ]);
    }
    }
}
