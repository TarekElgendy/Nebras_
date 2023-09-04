<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Section;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        #SEEDER
         $this->call(LaratrustSeeder::class);
           $this->call(AdminSeeder::class);
          $this->call(SettingSeeder::class);


        $this->call(SectionSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PageSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductSeeder::class);


        #FACER
        // Setting::factory(1)->create();
        //  Section::factory(4)->create();


    }
}
