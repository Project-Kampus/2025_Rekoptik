<?php

namespace Database\Factories;

use App\Models\RmPemeriksaan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RmPemeriksaan>
 */
class RmPemeriksaanFactory extends Factory
{
    protected $model = RmPemeriksaan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $keluhanList = [
            'Pandangan buram saat membaca',
            'Penglihatan jauh kabur',
            'Mata lelah saat melihat dekat',
            'Sakit kepala setelah membaca',
            'Pandangan silang',
        ];

        $penyakitList = [
            'Presbiopia',
            'Miopia',
            'Hipermetropia',
            'Astigmatisme',
            'Presbyopia',
        ];

        $diagnosalist = [
            'Presbiopia ringan',
            'Miopia sedang',
            'Hipermetropia ringan',
            'Astigmatisme sedang',
            'Presbyopia dengan astigmatisme',
        ];

        return [
            'pasien_id' => null, // Akan diset di seeder
            'user_id' => 1, // Default ke user pertama
            'no_sep' => $this->faker->boolean(30) ? 'SEP-' . $this->faker->year() . '-' . $this->faker->numerify('###') : null,
            'keluhan_utama' => $this->faker->randomElement($keluhanList),
            'riwayat_penyakit' => $this->faker->boolean(50) ? $this->faker->sentence() : 'Tidak ada',
            'penyakit_sekarang' => $this->faker->randomElement($penyakitList),
            'penyakit_keluarga' => $this->faker->boolean(40) ? $this->faker->randomElement($penyakitList) : 'Tidak diketahui',
            'kebiasaan' => $this->faker->sentence(),
            'pengobatan' => $this->faker->boolean(50) ? $this->faker->sentence() : 'Belum ada',
            'diagnosa' => $this->faker->randomElement($diagnosalist),
        ];
    }
}
