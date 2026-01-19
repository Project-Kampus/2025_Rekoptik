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
        Schema::create('rm_pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasien');
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('umur')->nullable();
            $table->enum('kategori', ['bpjs', 'asuransi', 'umum']);
            $table->string('no_kartu')->nullable();
            $table->enum('kelas', ['1', '2', '3'])->nullable();
            $table->timestamps();
        });

        Schema::create('rm_pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('user_id');
            $table->string('no_sep')->nullable();

            $table->text('keluhan_utama')->nullable();
            $table->text('riwayat_penyakit')->nullable();
            $table->text('penyakit_sekarang')->nullable();
            $table->text('penyakit_keluarga')->nullable();
            $table->text('kebiasaan')->nullable();
            $table->text('pengobatan')->nullable();
            $table->string('diagnosa');
            $table->timestamps();

            $table->foreign('pasien_id')->references('id')->on('rm_pasiens')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('rm_resep', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemeriksaan_id');
            $table->string('resep_dari');
            $table->date('tanggal')->default(now());

            $table->decimal('od_sferis', 6, 2)->nullable();
            $table->decimal('od_silindris', 6, 2)->nullable();
            $table->integer('od_axis')->nullable();
            $table->decimal('od_add_lensa', 6, 2)->nullable();
            $table->decimal('pd_od', 5, 2)->nullable();

            $table->decimal('os_sferis', 6, 2)->nullable();
            $table->decimal('os_silindris', 6, 2)->nullable();
            $table->integer('os_axis')->nullable();
            $table->decimal('os_add_lensa', 6, 2)->nullable();
            $table->decimal('pd_os', 5, 2)->nullable();

            $table->timestamps();

            $table->foreign('pemeriksaan_id')->references('id')->on('rm_pemeriksaan')->onDelete('cascade');
        });

        Schema::create('rm_pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemeriksaan_id');
            $table->unsignedBigInteger('resep_id');
            $table->unsignedBigInteger('frame_id')->nullable();
            $table->unsignedBigInteger('lensa_id');
            $table->unsignedBigInteger('aksesoris_id')->nullable();
            $table->bigInteger('biaya_kacamata');
            $table->enum('status', ['dipesan', 'diambil']);
            $table->date('tanggal_dipesan')->default(now());
            $table->date('tanggal_pengambilan')->nullable();
            $table->timestamps();

            $table->foreign('pemeriksaan_id')->references('id')->on('rm_pemeriksaan')->onDelete('cascade');
            $table->foreign('resep_id')->references('id')->on('rm_resep')->onDelete('cascade');
            $table->foreign('frame_id')->references('id')->on('frames')->onDelete('cascade');
            $table->foreign('lensa_id')->references('id')->on('lensas')->onDelete('cascade');
            $table->foreign('aksesoris_id')->references('id')->on('aksesoris')->onDelete('cascade');
        });

        Schema::create('rm_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pesanan_id');
            $table->enum('metode', ['bpjs', 'asuransi', 'tunai']);
            $table->bigInteger('jumlah');
            $table->date('tanggal_bayar')->default(now());
            $table->timestamps();

            $table->foreign('pesanan_id')->references('id')->on('rm_pesanans')->onDelete('cascade');
        });

        Schema::create('rm_pengambilans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pesanan_id');
            $table->string('nama_pengambil');
            $table->string('hub_pengambil');
            $table->string('bukti_pengambil')->nullable();
            $table->timestamps();

            $table->foreign('pesanan_id')->references('id')->on('rm_pesanans')->onDelete('cascade');
        });

        Schema::create('rm_dokument', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokumens_id');
            $table->unsignedBigInteger('pemeriksaan_id');
            $table->text('url');
            $table->timestamps();

            $table->foreign('dokumens_id')->references('id')->on('dokumens')->onDelete('cascade');
            $table->foreign('pemeriksaan_id')->references('id')->on('rm_pemeriksaan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rm_dokument');
        Schema::dropIfExists('rm_pengambilans');
        Schema::dropIfExists('rm_pembayarans');
        Schema::dropIfExists('rm_pesanans');
        Schema::dropIfExists('rm_resep');
        Schema::dropIfExists('rm_pemeriksaan');
        Schema::dropIfExists('rm_pasiens');
    }
};
