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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            // Data Pasien
            $table->string('nama_pasien');
            $table->string('no_kartu')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('no_sep')->nullable();
            $table->date('tanggal_pemeriksaan');
            $table->string('alamat')->nullable();
            $table->enum('kategori', ["bpjs", 'umum']);

            // Resep Kacamata
            $table->decimal('od_sferis', 5, 2)->nullable();
            $table->decimal('od_silindris', 5, 2)->nullable();
            $table->integer('od_axis')->nullable();
            $table->decimal('od_add_lensa', 5, 2)->nullable();

            $table->decimal('os_sferis', 5, 2)->nullable();
            $table->decimal('os_silindris', 5, 2)->nullable();
            $table->integer('os_axis')->nullable();
            $table->decimal('os_add_lensa', 5, 2)->nullable();

            $table->string('resep_dari');

            // Kacamata yang Diberikan
            $table->string('lensa')->nullable();
            $table->string('pd',)->nullable();
            $table->foreignId('frame_id')->nullable()->constrained('frames')->nullOnDelete();

            // Biaya
            $table->unsignedBigInteger('biaya_kacamata')->default(0);
            $table->unsignedBigInteger('dibayar_bpjs')->default(0);
            $table->unsignedBigInteger('dibayar_pasien')->default(0);
            $table->unsignedBigInteger('sisa')->default(0);
            $table->date('tanggal_pengambilan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
