<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve existing user IDs
        $userIds = DB::table('users')->pluck('id');

        // Example data to be inserted
        $doctor = [
           
            [
                'name' => 'ali',
                'user_id' => $userIds->random(),
                'spec_id' => 2, // Replace with the appropriate spec_id
                'number' => '0991527629',
                'email' => 'ali@example.com',
                'disc' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'Img' => 'public/images/doctor.jpg'
            ],
            // Add more doctors as needed
        ];

        // Insert data into the 'Doctors' table
       
            DB::table('Doctors')->insert($doctor);
        
    }
}