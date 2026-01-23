<?php

namespace Database\Factories;

use App\Models\RmPasien;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RmPasien>
 */
class RmPasienFactory extends Factory
{
    protected $model = RmPasien::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $kategori = $this->faker->randomElement(['umum', 'bpjs', 'asuransi']);

        return [
            'nama_pasien' => $this->faker->name(),
            'no_hp' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'alamat' => $this->faker->address(),
            'umur' => $this->faker->numberBetween(18, 75),
            'kategori' => $kategori,
            'no_kartu' => $kategori === 'umum' ? null : $this->faker->unique()->numerify('##############'),
            'kelas' => $kategori === 'umum' ? null : $this->faker->randomElement(['1', '2', '3']),
        ];
    }

    /**
     * Pasien dengan kategori BPJS
     */
    public function bpjs(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'kategori' => 'bpjs',
                'no_kartu' => $this->faker->unique()->numerify('##############'),
                'kelas' => $this->faker->randomElement(['1', '2', '3']),
            ];
        });
    }

    /**
     * Pasien dengan kategori Asuransi
     */
    public function asuransi(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'kategori' => 'asuransi',
                'no_kartu' => $this->faker->unique()->numerify('##############'),
                'kelas' => $this->faker->randomElement(['1', '2', '3']),
            ];
        });
    }

    /**
     * Pasien dengan kategori Umum
     */
    public function umum(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'kategori' => 'umum',
                'no_kartu' => null,
                'kelas' => null,
            ];
        });
    }
}
