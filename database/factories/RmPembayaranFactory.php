<?php

namespace Database\Factories;

use App\Models\RmPembayaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RmPembayaran>
 */
class RmPembayaranFactory extends Factory
{
    protected $model = RmPembayaran::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pesanan_id' => null, // Akan diset di seeder
            // 'bpjs', 'asuransi', 'tunai', 'non-tunai'
            'metode' => $this->faker->randomElement(['tunai', 'non-tunai', 'bpjs', 'bpjs']),
            'jumlah' => 0, // Akan diset dari pesanan
            'tanggal_bayar' => now(),
        ];
    }

    /**
     * Pembayaran tunai
     */
    public function tunai(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'metode' => 'tunai',
            ];
        });
    }

    /**
     * Pembayaran transfer
     */
    public function transfer(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'metode' => 'transfer',
            ];
        });
    }

    /**
     * Pembayaran BPJS
     */
    public function bpjs(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'metode' => 'bpjs',
            ];
        });
    }
}
