<?php

namespace Database\Factories;

use App\Models\RmResep;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RmResep>
 */
class RmResepFactory extends Factory
{
    protected $model = RmResep::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pemeriksaan_id' => null, // Akan diset di seeder
            'resep_dari' => $this->faker->randomElement(['Optometris', 'Dokter Mata']),
            'tanggal' => now(),

            // Mata Kanan (OD)
            'od_sferis' => $this->faker->randomElement([-3.00, -2.50, -2.00, -1.50, -1.00, -0.50, 0.00, 0.50, 1.00, 1.50, 2.00]),
            'od_silindris' => $this->faker->randomElement([-1.50, -1.00, -0.75, -0.50, -0.25, 0.00]),
            'od_axis' => $this->faker->numberBetween(0, 180),
            'od_add_lensa' => $this->faker->boolean(40) ? $this->faker->randomElement([1.00, 1.25, 1.50, 1.75, 2.00]) : 0,
            'pd_od' => $this->faker->randomFloat(1, 29.5, 32.5),

            // Mata Kiri (OS)
            'os_sferis' => $this->faker->randomElement([-3.00, -2.50, -2.00, -1.50, -1.00, -0.50, 0.00, 0.50, 1.00, 1.50, 2.00]),
            'os_silindris' => $this->faker->randomElement([-1.50, -1.00, -0.75, -0.50, -0.25, 0.00]),
            'os_axis' => $this->faker->numberBetween(0, 180),
            'os_add_lensa' => $this->faker->boolean(40) ? $this->faker->randomElement([1.00, 1.25, 1.50, 1.75, 2.00]) : 0,
            'pd_os' => $this->faker->randomFloat(1, 29.5, 32.5),
        ];
    }
}
