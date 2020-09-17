<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_name' => 'gco_admin',
            'name' => 'GCO ADMIN',
            'image' => 'https://img.icons8.com/bubbles/50/000000/user.png',
            'email' => 'vvnam2706@gmail.com',
            'password' => Hash::make('1a2s3d4f5g6h'),
            'status' => 1, 
            'level' => 1,
        ]);
    }
}
