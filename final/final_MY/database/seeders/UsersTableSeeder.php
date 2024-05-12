<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
           
            [
                'name' => 'Ali',
                'email' => 'ali@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 0,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

      
            DB::table('users')->insert($user);
       
    }
}
