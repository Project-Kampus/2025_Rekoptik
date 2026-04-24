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
        Schema::create('lensas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lensa');
            $table->string('kategori');
            $table->string('material')->nullable();
            $table->string('coating')->nullable();
            $table->string('od')->nullable();
            $table->string('os')->nullable();
            $table->decimal('harga', 12, 2)->default(0);

            $table->foreignId('supplier_id')
                ->constrained('suppliers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lensas');
    }
};
