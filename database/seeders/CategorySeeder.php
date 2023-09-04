<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $en=[
            'MAKITA',
            'NBS',
            'INGCO',
            'STANLY',
            'CROWN',
            'HYUNDAI'
        ];
        $ar=[
            'ماكيتا',
            'ان بي اس',
            'انكو',
            'ستانلي',
            'كرون',
           'هينداي '
        ];
        for ($i=0; $i <=5 ; $i++) {
       \App\Models\Category::create([
            'section_id'=>1,
            'image'=>$i+1 .'.png',
            'ar'=>[
                'title'=>$ar[$i],
                'description'=>'وصف بالعربي ',
            ],
            'en'=>[
                'title'=>$en[$i],
                'description'=>"Des English ",
            ]
        ]);
    }
    }
}
