<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapPemeriksaanExport implements FromView
{
    protected $data;
    protected $tanggal_awal;
    protected $tanggal_akhir;

    public function __construct($data, $tanggal_awal, $tanggal_akhir)
    {
        $this->data = $data;
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
    }

    public function view(): View
    {
        return view('exports.rekap_pemeriksaan', [
            'data' => $this->data,
            'tanggal_awal' => $this->tanggal_awal,
            'tanggal_akhir' => $this->tanggal_akhir,
        ]);
    }
}
