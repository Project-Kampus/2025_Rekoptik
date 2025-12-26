<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'frames';

    /**
     * Mass assignment
     */
    protected $fillable = [
        'kode_frame',
        'nama_frame',
        'merk',
        'warna',
        'bahan',
        'kategori',
        'aktif',
        'harga',
        'stok',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'aktif' => 'boolean',
        'harga' => 'integer',
        'stok' => 'integer',
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
     * Relasi ke histori stok
     */
    public function stok()
    {
        return $this->hasMany(frame_stoks::class);
    }

    /**
     * Scope: hanya frame aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
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
