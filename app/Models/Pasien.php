<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{

    protected $fillable = [
        'nama_pasien',
        'no_hp',
        'no_kartu',
        'alamat',

        'keluhan_utama',
        'riwayat_penyakit',
        'penyakit_sekarang',
        'penyakit_keluarga',
        'kebiasaan',
        'pengobatan',

        'resep_dari',
        'no_sep',
        'tanggal_pemeriksaan',
        'diagnosa',
        'kategori',

        'od_sferis',
        'od_silindris',
        'od_axis',
        'od_add_lensa',
        'os_sferis',
        'os_silindris',
        'os_axis',
        'os_add_lensa',

        'frame_id',
        // 'lensa',
        'lensa_id',
        'pd',

        'biaya_kacamata',
        'dibayar_bpjs',
        'dibayar_asuransi',
        'dibayar_pasien',
        'sisa',

        'tanggal_dipesan',
        'tanggal_pengambilan',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'tanggal_dipesan' => 'date',
        'tanggal_pengambilan' => 'date',
    ];

    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }

    public function lensa()
    {
        return $this->belongsTo(Lensa::class);
    }


    public function hitungSisa()
    {
        return max(
            0,
            ($this->biaya_kacamata ?? 0)
                - (
                    ($this->dibayar_bpjs ?? 0)
                    + ($this->dibayar_asuransi ?? 0)
                    + ($this->dibayar_pasien ?? 0)
                )
        );
    }
}
