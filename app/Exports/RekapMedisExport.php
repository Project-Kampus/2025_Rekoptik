<?php

namespace App\Exports;

use App\Models\Pasien;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class RekapMedisExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Pasien::with('frame');

        // SEARCH
        if ($this->request->filled('q')) {
            $query->where(function ($q) {
                $q->where('nama_pasien', 'like', '%' . $this->request->q . '%')
                    ->orWhere('no_kartu', 'like', '%' . $this->request->q . '%');
            });
        }

        // FILTER KATEGORI
        if ($this->request->filled('kategori')) {
            $query->where('kategori', $this->request->kategori);
        }

        // FILTER TANGGAL
        if (
            $this->request->filled('tanggal_awal') &&
            $this->request->filled('tanggal_akhir')
        ) {
            $query->whereBetween('tanggal_pemeriksaan', [
                $this->request->tanggal_awal,
                $this->request->tanggal_akhir
            ]);
        }

        $pasiens = $query
            ->orderBy('tanggal_pemeriksaan', 'desc')
            ->get();

        return view('export.rekapMedis_excel', compact('pasiens'));
    }
}
