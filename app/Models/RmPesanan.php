<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmPesanan extends Model
{
    use HasFactory;

    protected $table = 'rm_pesanans';

    protected $fillable = [
        'pemeriksaan_id',
        'resep_id',
        'frame_id',
        'lensa_id',
        'biaya_kacamata',
        'status',
        'tanggal_dipesan',
        'tanggal_pengambilan',
    ];
    public function aksesoris()
    {
        return $this->belongsToMany(Aksesoris::class, 'pesanan_aksesoris', 'pesanan_id', 'aksesoris_id')->withPivot('jumlah')->withTimestamps();
    }


    protected $casts = [
        'tanggal_dipesan' => 'date',
        'tanggal_pengambilan' => 'date',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(RmPemeriksaan::class);
    }

    public function resep()
    {
        return $this->belongsTo(RmResep::class);
    }

    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }

    public function lensa()
    {
        return $this->belongsTo(Lensa::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(RmPembayaran::class, 'pesanan_id');
    }

    public function pengambilan()
    {
        return $this->hasOne(RmPengambilan::class, 'pesanan_id');
    }
}
