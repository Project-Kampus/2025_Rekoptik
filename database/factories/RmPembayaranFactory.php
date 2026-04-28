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
            'kategori' => $this->faker->randomElement(['bpjs', 'asuransi', 'dp', 'lunas']),
            'metode' => $this->faker->randomElement(['tunai', 'non_tunai']),
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
     * Pembayaran non-tunai (transfer)
     */
    public function nonTunai(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'metode' => 'non_tunai',
            ];
        });
    }

    /**
     * Kategori pembayaran BPJS
     */
    public function kategoriBpjs(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'kategori' => 'bpjs',
            ];
        });
    }

    /**
     * Kategori pembayaran Asuransi
     */
    public function kategoriAsuransi(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'kategori' => 'asuransi',
            ];
        });
    }

    /**
     * Kategori pembayaran DP
     */
    public function kategoriDp(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'kategori' => 'dp',
            ];
        });
    }

    /**
     * Kategori pembayaran Lunas
     */
    public function kategoriLunas(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'kategori' => 'lunas',
            ];
        });
    }
}
