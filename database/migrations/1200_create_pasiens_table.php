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
            $table->string('no_hp')->nullable();
            $table->string('no_kartu')->nullable();
            $table->string('alamat')->nullable();

            // pemeriksaan
            $table->string('resep_dari');
            $table->string('no_sep')->nullable();
            $table->date('tanggal_pemeriksaan');
            $table->string('diagnosa');
            $table->enum('kategori', ["bpjs", 'umum']);

            // Resep Kacamata
            $table->decimal('od_sferis', 5, 2)->nullable();
            $table->decimal('od_silindris', 5, 2)->nullable();
            $table->decimal('od_axis', 5, 2)->nullable();
            $table->integer('od_add_lensa')->nullable();

            $table->decimal('os_sferis', 5, 2)->nullable();
            $table->decimal('os_silindris', 5, 2)->nullable();
            $table->decimal('os_axis', 5, 2)->nullable();
            $table->integer('os_add_lensa')->nullable();


            // Kacamata yang Diberikan
            $table->string('lensa')->nullable();
            $table->string('pd',)->nullable();
            $table->foreignId('frame_id')->nullable()->constrained('frames')->nullOnDelete();

            // Biaya
            $table->unsignedBigInteger('biaya_kacamata')->default(0);
            $table->unsignedBigInteger('dibayar_bpjs')->default(0);
            $table->unsignedBigInteger('dibayar_pasien')->default(0);
            $table->unsignedBigInteger('sisa')->default(0);

            $table->date('tanggal_dipesan')->nullable();
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
