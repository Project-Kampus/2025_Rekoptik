<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmPembayaran extends Model
{
    use HasFactory;

    protected $table = 'rm_pembayarans';

    protected $fillable = [
        'pesanan_id',
        'metode',
        // 'bpjs', 'asuransi', 'tunai', 'non-tunai'
        'jumlah',
        'tanggal_bayar',
    ];

    protected $casts = [
        'tanggal_bayar' => 'date',
    ];

    public function pesanan()
    {
        return $this->belongsTo(RmPesanan::class, 'pesanan_id');
    }
}
