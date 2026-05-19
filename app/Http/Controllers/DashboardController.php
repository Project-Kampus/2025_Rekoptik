<?php

namespace App\Http\Controllers;

use App\Models\RmPemeriksaan;
use App\Models\RmPasien;
use App\Models\RmPesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $bulanNames = [
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
    public function index()
    {
        if (auth()->check() && (auth()->user()->hasRole('bpjs') || auth()->user()->hasRole('asuransi'))) {
            return $this->indexMitra();
        }

        // return $this->indexsampel();
        return $this->indexreal();
    }

    protected function indexMitra()
    {
        $today = Carbon::today();
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $currentDay = Carbon::now()->day;
        $category = auth()->user()->hasRole('bpjs') ? 'bpjs' : 'asuransi';
        $categoryLabel = ucfirst($category);

        $totalCategory = RmPasien::where('kategori', $category)->count();

        $hariIni = RmPemeriksaan::whereHas('pasien', function ($query) use ($category) {
            $query->where('kategori', $category);
        })->whereDate('created_at', $today)->count();

        $kunjunganBulanIni = RmPemeriksaan::whereHas('pasien', function ($query) use ($category) {
            $query->where('kategori', $category);
        })->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $belumDiambil = RmPesanan::where('status', 'dipesan')
            ->whereHas('pemeriksaan.pasien', function ($query) use ($category) {
                $query->where('kategori', $category);
            })
            ->count();

        $aktivitas = RmPemeriksaan::with('pasien')
            ->whereHas('pasien', function ($query) use ($category) {
                $query->where('kategori', $category);
            })->whereDate('created_at', $today)
            ->latest()
            ->get()
            ->map(function ($item) {
                return (object) [
                    'id' => $item->id,
                    'tanggal_pemeriksaan' => $item->created_at,
                    'nama_pasien' => $item->pasien->nama_pasien ?? '-',
                    'kategori' => $item->pasien->kategori ?? '-',
                ];
            });

        // Data grafik kunjungan bulanan tahun ini (khusus mitra)
        $bulanNames = [
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
        $grafikData = [];

        for ($month = 1; $month <= 12; $month++) {
            $count = RmPemeriksaan::whereHas('pasien', function ($query) use ($category) {
                $query->where('kategori', $category);
            })->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();
            $grafikData[] = $count;
        }

        return view('dashboard-mitra', compact(
            'category',
            'categoryLabel',
            'totalCategory',
            'hariIni',
            'kunjunganBulanIni',
            'belumDiambil',
            'aktivitas',
            'grafikData',
            'bulanNames'
        ));
    }

    public function indexreal()
    {
        $today = Carbon::today();
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $currentDay = Carbon::now()->day;

        $totalPasien = RmPasien::count();
        $totalBpjs = RmPasien::where('kategori', 'bpjs')->count();
        $totalUmum = RmPasien::where('kategori', 'umum')->count();
        $totalAsuransi = RmPasien::where('kategori', 'asuransi')->count();

        $hariIni = RmPemeriksaan::whereDate('created_at', $today)->count();
        $kunjunganBulanIni = RmPemeriksaan::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();
        $rataRataHarian = $currentDay > 0 ? round($kunjunganBulanIni / $currentDay, 2) : 0;
        $belumDiambil = RmPesanan::where('status', 'dipesan')->count();
        $belumDiambilColor = $belumDiambil > 0 ? 'text-red-600' : 'text-green-600';

        $aktivitas = RmPemeriksaan::with('pasien')
            ->whereDate('created_at', $today)
            ->latest()
            ->get()
            ->map(function ($item) {
                return (object) [
                    'id' => $item->id,
                    'tanggal_pemeriksaan' => $item->created_at,
                    'nama_pasien' => $item->pasien->nama_pasien ?? '-',
                    'kategori' => $item->pasien->kategori ?? '-',
                ];
            });

        // Data grafik kunjungan pasien per bulan (tahun saat ini)
        $grafikData = [];
        $bulanNames = $this->bulanNames;

        for ($month = 1; $month <= 12; $month++) {
            $count = RmPemeriksaan::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();
            $grafikData[] = $count;
        }

        $lastMonthDate = Carbon::now()->subMonthNoOverflow();
        $lastMonthLimitDay = min($currentDay, $lastMonthDate->daysInMonth);
        $lastMonthEnd = $lastMonthDate->copy()->day($lastMonthLimitDay)->endOfDay();

        $kunjunganBulanLalu = RmPemeriksaan::whereBetween('created_at', [
            $lastMonthDate->copy()->startOfMonth(),
            $lastMonthEnd,
        ])->count();

        $trendPercent = null;
        if ($kunjunganBulanLalu > 0) {
            $trendPercent = round((($kunjunganBulanIni - $kunjunganBulanLalu) / $kunjunganBulanLalu) * 100, 2);
        }

        $totalKategori = max(1, $totalPasien);
        $bpjsShare = round($totalBpjs / $totalKategori * 100, 1);
        $umumShare = round($totalUmum / $totalKategori * 100, 1);
        $asuransiShare = round($totalAsuransi / $totalKategori * 100, 1);

        $analysis = [
            "Kunjungan bulan ini tercatat sebanyak {$kunjunganBulanIni} pasien, dengan rata-rata {$rataRataHarian} pasien per hari.",
            $trendPercent !== null
                ? "Performa kunjungan {$trendPercent}% " . ($trendPercent >= 0 ? 'naik' : 'turun') . " dibanding periode yang sama bulan lalu."
                : 'Perbandingan bulan lalu belum tersedia karena data belum lengkap.',
            "Komposisi pasien: BPJS {$bpjsShare}%, Umum {$umumShare}%, Asuransi {$asuransiShare}%.",
            $belumDiambil > 0
                ? "Terdapat {$belumDiambil} pesanan yang belum diambil; pastikan follow up untuk menyelesaikan transaksi dan meningkatkan kas."
                : 'Semua pesanan telah diambil saat ini, operasional berjalan lancar.'
        ];

        return view('dashboard', compact(
            'totalPasien',
            'totalBpjs',
            'totalAsuransi',
            'totalUmum',
            'hariIni',
            'belumDiambil',
            'aktivitas',
            'bulanNames',
            'grafikData',
            'kunjunganBulanIni',
            'rataRataHarian',
            'trendPercent',
            'analysis'
        ));
    }

    public function indexsampel()
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
        $bulanNames = $this->bulanNames;

        $grafikData = [
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
            'bulanNames',
            'grafikData'
        ));
    }

}
