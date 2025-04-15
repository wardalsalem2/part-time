<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\User;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sara = User::where('email', 'sara@company.com')->first();
        $ali = User::where('email', 'ali@company.com')->first();

        $companies = [
            [
                'user_id' => $sara->id,
                'name' => 'Sara Tech Solutions',
                'description' => 'A tech startup based in Amman, Jordan specializing in mobile apps.',
                'industry' => 'Technology',
                'website' => 'https://saratech.jo',
                'phone' => '0791112233',
                'email' => 'contact@saratech.jo',
                'address' => 'Shmeisani, Amman',
                'city' => 'Amman',
                'num_employees' => 15,
                'is_active' => true,
            ],
            [
                'user_id' => $ali->id,
                'name' => 'Ali Marketing Co.',
                'description' => 'Digital marketing company based in Irbid, Jordan.',
                'industry' => 'Marketing',
                'website' => 'https://alimarketing.jo',
                'phone' => '0785556677',
                'email' => 'info@alimarketing.jo',
                'address' => 'Wasfi Al-Tal St, Irbid',
                'city' => 'Irbid',
                'num_employees' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
