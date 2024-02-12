<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SKD>
 */
class SKDFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_surat' => fake()->unique()->text(10),
            'patient_id' => mt_rand(1, 10),
            'diagnosa' => fake()->sentence,
            'doctor_id' => mt_rand(1, 10),
            'tanggal_masuk' => fake()->date(),
            'tanggal_keluar' => fake()->date(),
        ];
    }
}
