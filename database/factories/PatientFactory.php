<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => fake()->nik(),
            'nama' => fake()->name(),
            'umur' => fake()->numberBetween(1, 100),
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date(),
            'telepon' => fake()->phoneNumber(),
            'pekerjaan' => fake()->jobTitle(),
            'partner_id' => mt_rand(1, 3),
            'alamat' => fake()->address(),
        ];
    }
}
