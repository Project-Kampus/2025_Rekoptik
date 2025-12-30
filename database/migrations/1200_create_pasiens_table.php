<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();

            // Data Pasien
            $table->string('nama_pasien');
            $table->string('no_hp')->nullable();
            $table->string('no_kartu')->nullable();
            $table->text('alamat')->nullable();

            // Pemeriksaan
            $table->string('resep_dari');
            $table->string('no_sep')->nullable();
            $table->date('tanggal_pemeriksaan');
            $table->string('diagnosa');
            $table->enum('kategori', ['bpjs', 'asuransi', 'umum']);

            // Resep OD
            $table->decimal('od_sferis', 6, 2)->nullable();
            $table->decimal('od_silindris', 6, 2)->nullable();
            $table->decimal('od_axis', 6, 2)->nullable();
            $table->decimal('od_add_lensa', 6, 2)->nullable();

            // Resep OS
            $table->decimal('os_sferis', 6, 2)->nullable();
            $table->decimal('os_silindris', 6, 2)->nullable();
            $table->decimal('os_axis', 6, 2)->nullable();
            $table->decimal('os_add_lensa', 6, 2)->nullable();

            // Kacamata
            $table->foreignId('frame_id')->nullable()->constrained()->nullOnDelete();
            $table->string('lensa')->nullable();
            $table->string('pd')->nullable();

            // Pembayaran
            $table->bigInteger('biaya_kacamata')->default(0);
            $table->bigInteger('dibayar_bpjs')->default(0);
            $table->bigInteger('dibayar_asuransi')->default(0);
            $table->bigInteger('dibayar_pasien')->default(0);
            $table->bigInteger('sisa')->default(0);

            $table->date('tanggal_dipesan')->nullable();
            $table->date('tanggal_pengambilan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};

