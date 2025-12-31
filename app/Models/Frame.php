<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;

    protected $table = 'frames';

    /**
     * Mass assignment
     */
    protected $fillable = [
        'kode_frame',
        'merk',
        'warna',
        'bahan',
        'kategori',
        'harga',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'harga' => 'integer',
    ];

    /**
     * Relasi ke Pasien
     * Satu frame bisa dipakai banyak pasien
     */
    public function pasiens()
    {
        return $this->hasMany(Pasien::class);
    }

    /**
     * Scope: frame BPJS
     */
    public function scopeBpjs($query)
    {
        return $query->where('kategori', 'bpjs');
    }

    /**
     * Scope: frame non-BPJS
     */
    public function scopeNonBpjs($query)
    {
        return $query->where('kategori', 'non_bpjs');
    }
}
