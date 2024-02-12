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
            'password' => Hash::make('admin')
        ]);

        \App\Models\User::factory(10)->create();  
        \App\Models\Doctor::factory(10)->create();
        \App\Models\Patient::factory(10)->create();

        \App\Models\SKD::factory(10)->create();
    }
}
