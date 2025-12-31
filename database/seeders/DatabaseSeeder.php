<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $bpjsRole  = Role::firstOrCreate(['name' => 'bpjs']);

        $admin = User::firstOrCreate(
            [
                'email' => 'admin@gmail.com',
                'name'     => 'Administrator',
                'password' => Hash::make('password'),
            ]
        );
        $admin->roles()->syncWithoutDetaching([$adminRole->id]);


        $bpjs = User::firstOrCreate(
            [
                'email' => 'bpjs@gmail.com',
                'name'     => 'Petugas BPJS',
                'password' => Hash::make('password'),
            ]
        );

        $bpjs->roles()->syncWithoutDetaching([$bpjsRole->id]);

        // frame
        $this->call([
            SupplierSeeder::class,
            FrameSeeder::class,
            LensaSeeder::class,
            // PasienSeeder::class,
            PengaturanSeeder::class
        ]);
    }
}
