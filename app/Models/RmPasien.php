<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RmPasien extends Model
{
    use HasFactory;

    protected $table = 'rm_pasiens';

    protected $fillable = [
        'nama_pasien',
        'no_hp',
        'email',
        'alamat',
        'umur',
        'kategori',
        'no_kartu',
        'kelas',
    ];

    public function pemeriksaans()
    {
        return $this->hasMany(RmPemeriksaan::class, 'pasien_id');
    }
}
