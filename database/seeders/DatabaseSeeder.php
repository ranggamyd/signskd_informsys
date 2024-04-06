<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@admin',
            'avatar' => 'default.jpg',
            'password' => Hash::make('admin'),
            'role' => 'Administrator'
        ]);

        \App\Models\Partner::factory(3)->create();
        
        \App\Models\User::factory()->create([
            'name' => 'Mitra 1',
            'username' => 'mitra1',
            'email' => 'mitra1@mitra1',
            'avatar' => 'default.jpg',
            'password' => Hash::make('mitra1'),
            'role' => 'HRD',
            'partner_id' => 1
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Mitra 2',
            'username' => 'mitra2',
            'email' => 'mitra2@mitra2',
            'avatar' => 'default.jpg',
            'password' => Hash::make('mitra2'),
            'role' => 'HRD',
            'partner_id' => 2
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Mitra 3',
            'username' => 'mitra3',
            'email' => 'mitra3@mitra3',
            'avatar' => 'default.jpg',
            'password' => Hash::make('mitra3'),
            'role' => 'HRD',
            'partner_id' => 3
        ]);

        \App\Models\Doctor::factory(10)->create();
        \App\Models\Patient::factory(10)->create();

        \App\Models\SKD::factory(10)->create();
    }
}
