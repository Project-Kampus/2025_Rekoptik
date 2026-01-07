<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien    = 128;
        $totalBpjs      = 62;
        $totalUmum      = 41;
        $totalAsuransi  = 25;
        $hariIni = 7;
        $belumDiambil = 12;
        $aktivitas = collect([
            (object) [
                'id' => 1,
                'tanggal_pemeriksaan' => Carbon::now()->subDays(1),
                'nama_pasien' => 'Ahmad Fauzi',
                'kategori' => 'bpjs',
            ],
            (object) [
                'id' => 2,
                'tanggal_pemeriksaan' => Carbon::now()->subDays(2),
                'nama_pasien' => 'Siti Aminah',
                'kategori' => 'umum',
            ],
            (object) [
                'id' => 3,
                'tanggal_pemeriksaan' => Carbon::now()->subDays(3),
                'nama_pasien' => 'Budi Santoso',
                'kategori' => 'asuransi',
            ],
        ]);
        $bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $jumlahPasien = [
            5,
            8,
            12,
            9,
            14,
            18,
            22,
            20,
            17,
            15,
            10,
            7
        ];

        return view('dashboard', compact(
            'totalPasien',
            'totalBpjs',
            'totalAsuransi',
            'totalUmum',
            'hariIni',
            'belumDiambil',
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
