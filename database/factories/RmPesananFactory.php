<?php

namespace Database\Factories;

use App\Models\RmPesanan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RmPesanan>
 */
class RmPesananFactory extends Factory
{
    protected $model = RmPesanan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['dipesan', 'diambil']);
        $tanggalDipesan = $this->faker->dateTimeBetween('-30 days', 'now');

        return [
            'pemeriksaan_id' => null, // Akan diset di seeder
            'resep_id' => null, // Akan diset di seeder
            'frame_id' => $this->faker->numberBetween(1, 5),
            'lensa_id' => $this->faker->numberBetween(1, 5),
            'aksesoris_id' => $this->faker->boolean(50) ? $this->faker->numberBetween(1, 5) : null,
            'biaya_kacamata' => $this->faker->numberBetween(500000, 2000000),
            'status' => $status,
            'tanggal_dipesan' => $tanggalDipesan,
            'tanggal_pengambilan' => $status === 'diambil' ? $this->faker->dateTimeBetween($tanggalDipesan, '+7 days') : null,
        ];
    }

    /**
     * Status dipesan
     */
    public function dipesan(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'dipesan',
                'tanggal_pengambilan' => null,
            ];
        });
    }

    /**
     * Status sedang diproses
     */
    public function sedangDiproses(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'sedang diproses',
                'tanggal_pengambilan' => null,
            ];
        });
    }

    /**
     * Status diambil
     */
    public function diambil(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'diambil',
                'tanggal_pengambilan' => $this->faker->dateTime(),
            ];
        });
    }
}
