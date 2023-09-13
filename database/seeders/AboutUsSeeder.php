<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AboutUs::create([
            'company_name' => ['en' => 'bevatel', 'ar' => 'بيفاتل'],
            'description' => ['en' => 'bevatel' , 'ar' => 'بيفاتل'],
            'creation_date' => '10Mar2022',
            'image' => 'bevatel.com/logo.png'
        ]);
    }



}
