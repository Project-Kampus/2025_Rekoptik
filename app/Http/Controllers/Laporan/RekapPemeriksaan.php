<?php

namespace App\Http\Controllers\Laporan;

use App\Exports\RekapPemeriksaanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\RmPemeriksaan;
use Illuminate\Http\Request;

class RekapPemeriksaan extends Controller
{
    public function index(Request $request)
    {
        $query = RmPemeriksaan::with(['pasien', 'resep']);

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereHas('resep', function ($q) use ($request) {
                $q->whereBetween('tanggal', [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]);
            });
        }

        $data = $query->latest()->paginate(25)->withQueryString();

        return view('admin.laporan.rekap_pemeriksaan_index', compact('data'));
    }

    public function export(Request $request)
    {
        $query = RmPemeriksaan::with(['pasien', 'resep']);

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereHas('resep', function ($q) use ($request) {
                $q->whereBetween('tanggal', [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]);
            });
        }

        $data = $query->latest()->get();

        return Excel::download(new RekapPemeriksaanExport($data, $request->tanggal_awal, $request->tanggal_akhir), 'rekap-pemeriksaan.xlsx');
    }
}
