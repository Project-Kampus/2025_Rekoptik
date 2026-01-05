<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmPemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'rm_pemeriksaan';

    protected $fillable = [
        'pasien_id',
        'user_id',
        'no_sep',
        
        'keluhan_utama',
        'riwayat_penyakit',
        'penyakit_sekarang',
        'penyakit_keluarga',
        'kebiasaan',
        'pengobatan',
        'diagnosa',
    ];

    public function pasien()
    {
        return $this->belongsTo(RmPasien::class, 'pasien_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resep()
    {
        return $this->hasOne(RmResep::class, 'pemeriksaan_id');
    }

    public function pesanan()
    {
        return $this->hasOne(RmPesanan::class, 'pemeriksaan_id');
    }

    public function dokumens()
    {
        return $this->hasMany(RmDokument::class, 'pemeriksaan_id');
    }
}
