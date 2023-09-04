<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=1; $i <=5 ; $i++) {
            \App\Models\Product::create([

                'category_id' => $i,

                'sku'=>'SKU . '.$i+5252,
                'brand_id'=>$i,
                'image'=>$i.'.webp',
                'image2'=>$i.'.webp',
                'icon'=>$i.'.webp',
                'price'=>150*$i,
                'old_price'=>250*$i,
                'min_stock'=>20,
                'stock'=>50*$i,


                'warrantyInfo'=>'3  year warrenty',

                'manufacturerCountry'=>'Jabanes',
                'length'=>150,
                'width'=>80,
                'height'=>21.5,
                'weight'=>30.5,

                'ar'=>[
                    'title'=> 'عنوان المنتج رقم ' .  $i,
                    'short_description'=> 'وصف قصير للمنتج رقم ' .  $i,
                    'description'=> 'وصف المنتج   رقم ' .  $i,


                ],
                'en'=>[
                    'title'=> 'title product no ' .  $i,
                    'short_description'=>  'short_description product no ' .  $i,
                    'description'=> 'description product no ' .  $i,
                ]
            ]);
        }

    }
}
/*


category_id
brand_id
image
image2
icon
price
old_price
min_stock
stock
stock_availability
warranty
warrantyInfo
Refundable
taxesIncluded
availableColors
listAvailableColors
poweredBy
manufacturerCountry
length
width
height
weight
link
video
createdBy
editeBy
rank
status
mainPage
*/
