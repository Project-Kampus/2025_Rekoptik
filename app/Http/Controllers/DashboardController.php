<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        // TOTAL DATA
        $totalPasien = Pasien::count();

        $totalBpjs = Pasien::where('kategori', 'bpjs')->count();
        $totalUmum = Pasien::where('kategori', 'umum')->count();

        $hariIni = Pasien::whereDate('tanggal_pemeriksaan', Carbon::today())->count();

        // AKTIVITAS TERBARU (5 DATA)
        $aktivitas = Pasien::orderBy('tanggal_pemeriksaan', 'desc')
            ->limit(5)
            ->get();

        // GRAFIK PASIEN BULANAN (12 BULAN TERAKHIR)
        $grafik = Pasien::select(
            DB::raw('MONTH(tanggal_pemeriksaan) as bulan'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('tanggal_pemeriksaan', date('Y'))
            ->groupBy(DB::raw('MONTH(tanggal_pemeriksaan)'))
            ->orderBy(DB::raw('MONTH(tanggal_pemeriksaan)'))
            ->get();

        // FORMAT BULAN
        $bulan = [];
        $jumlahPasien = [];

        foreach ($grafik as $row) {
            $bulan[] = Carbon::create()->month($row->bulan)->translatedFormat('F');
            $jumlahPasien[] = $row->total;
        }

        return view('dashboard', compact(
            'totalPasien',
            'totalBpjs',
            'totalUmum',
            'hariIni',
            'aktivitas',
            'bulan',
            'jumlahPasien'
        ));
    }
}
