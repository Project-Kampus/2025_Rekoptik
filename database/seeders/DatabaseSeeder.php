<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // user admin
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // frame
        $this->call([
            SupplierSeeder::class,
            FrameSeeder::class,
            LensaSeeder::class,
            PasienSeeder::class,
            PengaturanSeeder::class
        ]);
    }
}
