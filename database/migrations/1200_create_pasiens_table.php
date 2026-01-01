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
            $table->integer('umur')->nullable();
            $table->string('email');

            // riwayar keluhan
            $table->text('keluhan_utama')->nullable();
            $table->text('riwayat_penyakit')->nullable();
            $table->text('penyakit_sekarang')->nullable();
            $table->text('penyakit_keluarga')->nullable();
            $table->text('kebiasaan')->nullable();
            $table->text('pengobatan')->nullable();

            // Pemeriksaan
            $table->string('resep_dari')->nullable();
            $table->string('no_sep')->nullable();
            $table->date('tanggal_pemeriksaan');
            $table->string('diagnosa');
            $table->enum('kategori', ['bpjs', 'asuransi', 'umum']);
            $table->enum('kelas', [1, 2, 3])->nullable();

            // Resep OD
            $table->decimal('od_sferis', 6, 2)->nullable();
            $table->decimal('od_silindris', 6, 2)->nullable();
            $table->integer('od_axis')->nullable();
            $table->decimal('od_add_lensa', 6, 2)->nullable();

            // Resep OS
            $table->decimal('os_sferis', 6, 2)->nullable();
            $table->decimal('os_silindris', 6, 2)->nullable();
            $table->integer('os_axis')->nullable();
            $table->decimal('os_add_lensa', 6, 2)->nullable();

            // Kacamata
            $table->foreignId('frame_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('lensa_id')->nullable()->constrained('lensas')->nullOnDelete();
            $table->string('pd')->nullable();

            // Pembayaran
            $table->bigInteger('biaya_kacamata')->default(0);
            $table->bigInteger('dibayar_bpjs')->default(0);
            $table->bigInteger('dibayar_asuransi')->default(0);
            $table->bigInteger('dibayar_pasien')->default(0);
            $table->bigInteger('sisa')->default(0);

            // dokument
            $table->string('doc_ktp')->nullable();
            $table->string('doc_legalitas')->nullable();
            $table->string('doc_rujukan')->nullable();

            // Status Pesanan
            $table->enum('status', ['dipesan', 'diambil'])->default('dipesan');
            $table->date('tanggal_dipesan')->nullable();

            // pengambilan
            $table->date('tanggal_pengambilan')->nullable();
            $table->text('nama_pengambil')->nullable();
            $table->text('hub_pengambil')->nullable();
            $table->text('bukti_pengambil')->nullable();



            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
