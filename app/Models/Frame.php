<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;
    protected $table = 'frames';
    protected $fillable = [
        'supplier_id',
        'kode_frame',
        'merk',
        'warna',
        'bahan',
        'harga',
    ];


    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function pasiens()
    {
        return $this->hasMany(Pasien::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
