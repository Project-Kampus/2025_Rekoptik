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
        Schema::create('frame_stoks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('frame_id')
                ->constrained('frames')
                ->cascadeOnDelete();

            $table->enum('jenis', ['masuk', 'keluar']);
            $table->integer('jumlah');

            $table->string('keterangan')->nullable();
            $table->date('tanggal');

            // Opsional (jika pakai user login)
            // $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frame_stoks');
    }
};
