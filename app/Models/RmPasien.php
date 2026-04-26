<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RmPasien extends Model
{
    use HasFactory;

    protected $table = 'rm_pasiens';

    protected $fillable = [
        'nama_pasien',
        'no_hp',
        'email',
        'alamat',
        'tanggal_lahir',
        'kategori',
        // bpjs, asuransi, umum
        'no_kartu',
        'kelas'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function pemeriksaans()
    {
        return $this->hasMany(RmPemeriksaan::class, 'pasien_id');
    }

    /**
     * Get umur (age) calculated from tanggal_lahir
     */
    public function getUmurAttribute(): ?int
    {
        if (!$this->tanggal_lahir) {
            return null;
        }
        return Carbon::parse($this->tanggal_lahir)->age;
    }
}
