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

    public function riwayatAll(Request $request)
    {
        $rekam = DB::table('pasiens')
            ->join('frames', 'frames.id', '=', 'pasiens.frame_id')
            ->leftJoin('lensas', 'lensas.id', '=', 'pasiens.lensa_id')
            ->whereNotNull('pasiens.tanggal_pengambilan')
            ->select([
                'pasiens.tanggal_pengambilan as tanggal',
                'pasiens.nama_pasien',

                // Frame
                'frames.kode_frame',
                'frames.merk as merk_frame',

                // Lensa
                'lensas.nama_lensa',
                'lensas.kategori',

                // Resep (OB / OS)
                'pasiens.od_sferis as od_sferis',
                'pasiens.od_silindris as od_silindris',
                'pasiens.od_axis as od_axis',
                'pasiens.od_add_lensa as od_add_lensa',

                'pasiens.os_sferis as os_sferis',
                'pasiens.os_silindris as os_silindris',
                'pasiens.os_axis as os_axis',
                'pasiens.os_add_lensa as os_add_lensa',
            ]);


        $query = DB::query()
            ->fromSub($rekam, 'riwayat')
            ->when($request->filled('from'), function ($q) use ($request) {
                $q->whereDate('tanggal', '>=', $request->from);
            })
            ->when($request->filled('to'), function ($q) use ($request) {
                $q->whereDate('tanggal', '<=', $request->to);
            });

        $riwayat = $query
            ->orderBy('tanggal', 'desc')
            ->paginate(20)
            ->withQueryString();


        return view('admin.frames_riwayatAll', compact('riwayat'));
    }
}
