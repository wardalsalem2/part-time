<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profilesData = [
            'Ahmad' => ['job_title' => 'Admin', 'hourly_rate' => null, 'available_hours' => null],
            'SaraCompany' => ['job_title' => 'Company Rep', 'hourly_rate' => null, 'available_hours' => null],
            'AliCompany' => ['job_title' => 'Manager', 'hourly_rate' => null, 'available_hours' => null],
            'Khaled' => ['job_title' => 'Graphic Designer', 'hourly_rate' => 15.00, 'available_hours' => 20],
            'Mona' => ['job_title' => 'Web Developer', 'hourly_rate' => 18.50, 'available_hours' => 25],
            'Yousef' => ['job_title' => 'Marketing Specialist', 'hourly_rate' => 20.00, 'available_hours' => 30],
            'Lina' => ['job_title' => 'Content Writer', 'hourly_rate' => 12.75, 'available_hours' => 15],
            'Omar' => ['job_title' => 'UI/UX Designer', 'hourly_rate' => 22.00, 'available_hours' => 10],
        ];

        foreach ($profilesData as $name => $data) {
            $user = User::where('name', $name)->first();

            if ($user) {
                Profile::create([
                    'user_id' => $user->id,
                    'job_title' => $data['job_title'],
                    'hourly_rate' => $data['hourly_rate'],
                    'available_hours' => $data['available_hours'],
                    'skills' => 'HTML, CSS, Laravel, Photoshop', // dummy data
                    'experience' => '2+ years experience in the field.', // dummy data
                    'city' => 'Amman',
                    'country' => 'Jordan',
                    'cv_path' => null,
                    'image_path' => null,
                    'is_active' => true,
                    'phone' => '0790000000',
                ]);
            }
        }
    }
}
