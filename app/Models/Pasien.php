<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{

    protected $fillable = [
        // Data Pasien
        'nama_pasien',
        'no_hp',
        'no_kartu',
        'alamat',
        'umur',

        // Riwayat
        'keluhan_utama',
        'riwayat_penyakit',
        'penyakit_sekarang',
        'penyakit_keluarga',
        'kebiasaan',
        'pengobatan',

        // Pemeriksaan
        'resep_dari',
        'no_sep',
        'tanggal_pemeriksaan',
        'diagnosa',
        'kategori',
        'kelas',

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
        'lensa_id',
        'pd',

        // Pembayaran
        'biaya_kacamata',
        'dibayar_bpjs',
        'dibayar_asuransi',
        'dibayar_pasien',
        'sisa',

        // Dokumen
        'doc_ktp',
        'doc_legalitas',
        'doc_rujukan',

        // Status & Tanggal
        'status',
        'tanggal_dipesan',

        'tanggal_pengambilan',
        'nama_pengambil',
        'hub_pengambil',
        'bukti_pengambil',
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
