<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmPengambilan extends Model
{
    use HasFactory;

    protected $table = 'rm_pengambilans';

    protected $fillable = [
        'pesanan_id',
        'nama_pengambil',
        'hub_pengambil',
        'bukti_pengambil',
    ];

    public function pesanan()
    {
        return $this->belongsTo(RmPesanan::class, 'pesanan_id');
    }
}
