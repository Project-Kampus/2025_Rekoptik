<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class frame_stoks extends Model
{
    use HasFactory;

    protected $table = 'frame_stoks';

    /**
     * Mass assignment
     */
    protected $fillable = [
        'frame_id',
        'jenis',
        'jumlah',
        'keterangan',
        'tanggal',
        // 'user_id',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'integer',
    ];

    /**
     * Relasi ke Frame
     */
    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }

    /**
     * Scope stok masuk
     */
    public function scopeMasuk($query)
    {
        return $query->where('jenis', 'masuk');
    }

    /**
     * Scope stok keluar
     */
    public function scopeKeluar($query)
    {
        return $query->where('jenis', 'keluar');
    }
}
