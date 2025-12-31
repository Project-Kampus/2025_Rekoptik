<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('frames', function (Blueprint $table) {
            $table->id();

            // Informasi Frame
            $table->string('kode_frame')->unique();
            $table->string('merk')->nullable();
            $table->string('warna')->nullable();
            $table->string('bahan')->nullable(); // metal, plastik, TR90, dll

            // Kategori & Status
            $table->enum('kategori', ['bpjs', 'non_bpjs'])->default('bpjs');

            // Harga & Stok
            $table->unsignedBigInteger('harga')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frames');
    }
};
