<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';

    /**
     * Mass assignment
     */
    protected $fillable = [
        // data pasien
        'nama_pasien',
        'no_hp',
        'no_kartu',
        'alamat',

        // pemeriksaan
        'resep_dari',
        'no_sep',
        'tanggal_pemeriksaan',
        'diagnosa',
        'kategori',

        // Resep OD
        'od_sferis',
        'od_silindris',
        'od_axis',
        'od_add_lensa',

        // Resep OS
        'os_sferis',
        'os_silindris',
        'os_axis',
        'os_add_lensa',


        // Kacamata
        'frame_id',
        'lensa',
        'pd',

        // Biaya
        'biaya_kacamata',
        'dibayar_bpjs',
        'dibayar_pasien',
        'sisa',

        'tanggal_dipesan',
        'tanggal_pengambilan',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_pemeriksaan' => 'date',
        'tanggal_dipesan' => 'date',
        'tanggal_pengambilan' => 'date',

        'od_sferis' => 'decimal:2',
        'od_silindris' => 'decimal:2',
        'od_axis' => 'decimal:2',

        'os_sferis' => 'decimal:2',
        'os_silindris' => 'decimal:2',
        'os_axis' => 'decimal:2',

    ];

    /**
     * Relasi ke Frame
     */
    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }

    /**
     * Helper: hitung sisa otomatis
     */
    public function hitungSisa()
    {
        return ($this->biaya_kacamata ?? 0)
            - (($this->dibayar_bpjs ?? 0) + ($this->dibayar_pasien ?? 0));
    }
}
