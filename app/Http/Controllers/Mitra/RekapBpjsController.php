<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\RmPesanan;
use Illuminate\Http\Request;
use App\Exports\RekapBpjsExport;
use Maatwebsite\Excel\Facades\Excel;

class RekapBpjsController extends Controller
{
    public function index(Request $request)
    {
        $query = RmPesanan::with([
            'pemeriksaan.pasien',
            'pemeriksaan.resep',
            'pembayarans',
            'pengambilan'
        ])->whereHas('pemeriksaan.pasien', function ($q) {
            $q->where('kategori', 'bpjs');
        })->orderByDesc('id');

        // Filter tanggal
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal_pengambilan', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $pesanan = $query->latest('tanggal_pengambilan')->paginate(50);

        return view('admin.mitra.bpjs_rekap_index', [
            'rekamMedis' => $pesanan
        ]);
    }

    public function export(Request $request)
    {
        $query = RmPesanan::with([
            'pemeriksaan.pasien',
            'pemeriksaan.resep',
            'pembayarans',
            'pengambilan'
        ])->whereHas('pemeriksaan.pasien', function ($q) {
            $q->where('kategori', 'bpjs');
        });

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal_pengambilan', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $data = $query->orderByDesc('id')->get();

        return Excel::download(new RekapBpjsExport($data, $request->tanggal_awal, $request->tanggal_akhir), 'rekap-bpjs.xlsx');
    }

    public function show(RmPesanan $pesanan)
    {
        $pesanan->load(
            'pemeriksaan.pasien',
            'pemeriksaan.resep',
            'pemeriksaan.dokumens.dokumen',
            'frame',
            'lensa',
            'aksesoris',
            'pembayarans',
            'pengambilan'
        );

        $uploadedDokumens = $pesanan->pemeriksaan->dokumens->keyBy('dokumens_id');
        $allDokumens = \App\Models\Document::all();

        return view('admin.mitra.bpjs_rekap_show', compact('pesanan', 'uploadedDokumens', 'allDokumens'));
    }
}
