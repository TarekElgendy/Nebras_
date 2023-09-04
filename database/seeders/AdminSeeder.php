<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin =\App\Models\Admin::create([
            'name' => 'super admin',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('123456'),
        ]);
       $super_admin->attachRole('super_admin');
    }
}






