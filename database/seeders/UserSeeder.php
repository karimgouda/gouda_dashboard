<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
       $user =  User::create(['name' => 'Super Admin', 'email' => 'super_admin@app.com', 'password' => Hash::make('123456')]);
       $user->syncRoles('super_admin');

    }
}
