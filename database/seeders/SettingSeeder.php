<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();
        $array = [
            ['key' => 'app_logo', 'value' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRbbCmKPUDYik8-Ol9Q6O6FmvDlyUk7STHZLwx1ek0Lqw&s', 'name' => 'App logo', 'rules' => 'required|mimes:jpeg,png,jpg,gif,webp,svg', 'type' => 'file', 'order' => 1],
            ['key' => 'app_favicon', 'value' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRbbCmKPUDYik8-Ol9Q6O6FmvDlyUk7STHZLwx1ek0Lqw&s', 'name' => 'Favicon', 'rules' => 'required|mimes:jpeg,png,jpg,gif,webp,svg', 'type' => 'file', 'order' => 3],
            ['key' => 'app_name_en', 'value' => 'Base Project', 'name' => 'App name en', 'rules' => 'required|string|max:20', 'type' => 'text', 'order' => 4],
            ['key' => 'app_name_ar', 'value' => 'Base Project', 'name' => 'App name ar', 'rules' => 'required|string|max:20', 'type' => 'text', 'order' => 5],
            ['key' => 'app_description_en', 'value' => 'Base description', 'name' => 'App description en', 'rules' => 'required|string', 'type' => 'text', 'order' => 6],
            ['key' => 'app_description_ar', 'value' => 'Base description', 'name' => 'App description ar', 'rules' => 'required|string', 'type' => 'text', 'order' => 7],
            ['key' => 'email', 'value' => 'email@example.com', 'name' => 'Email', 'rules' => 'required|email', 'type' => 'text', 'order' => 8],
            ['key' => 'phone', 'value' => '2010********', 'name' => 'Phone', 'rules' => 'required|string', 'type' => 'text', 'order' => 9],
            ['key' => 'address_en', 'value' => 'address example en', 'name' => 'address_en', 'rules' => 'required|string', 'type' => 'text', 'order' => 9],
            ['key' => 'address_ar', 'value' => 'address example ar', 'name' => 'address_ar', 'rules' => 'required|string', 'type' => 'text', 'order' => 9],
            ['key' => 'whatsapp', 'value' => '2010********', 'name' => 'whatsapp', 'rules' => 'required|string', 'type' => 'text', 'order' => 9],
            ['key' => 'map_link', 'value' => 'https://example.map', 'name' => 'map_link', 'rules' => 'required|string', 'type' => 'text', 'order' => 9],
            ['key' => 'head_manager_script', 'value' => '<script></script>', 'name' => 'Head Manager Script', 'rules' => 'nullable|string', 'type' => 'textarea', 'order' => 9],
            ['key' => 'body_manager_script', 'value' => '<script></script>', 'name' => 'Body Manager Script', 'rules' => 'nullable|string', 'type' => 'textarea', 'order' => 9],
            ['key'=>'video_presentation' , 'value'=>'https://example.map' , 'name'=>'video_presentation','rules'=>'nullable','type'=>'text','order'=>9],
            ['key'=>'desc_testimonial','value'=>' About Haifa al-Qahtani Law Firm and Legal Consulting' ,'name'=>'desc_testimonial','rules'=>'required|string','type'=>'textarea','order'=>9],
            ['key'=>'service_link','value'=>'https://www.facebook.com','name'=>'service_link','rules'=>'required|string','type'=>'text','order'=>9]

        ];
        foreach ($array as $list) {
            Setting::create($list);
        }
    }



}
