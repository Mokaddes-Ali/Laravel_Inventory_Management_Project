<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::create([
            'company_name' => 'ALI',
            'email' =>'abc@gmail.com',
            'mobile' => '0123456789',
            'address' => 'Dhaka',
            'logo' => 'logo.png',
            'creator' => 1,

        ]);

    }
}
