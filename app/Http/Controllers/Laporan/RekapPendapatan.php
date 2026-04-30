<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\RmPesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RekapPendapatan extends Controller
{
    /**
     * Calculate modal cost for a pesanan
     */
    private function calculateModalCost($pesanan)
    {
        $modalCost = 0;

        // Add frame modal
        if ($pesanan->frame) {
            $modalCost += $pesanan->frame->modal ?? 0;
        }

        // Add lensa modal
        if ($pesanan->lensa) {
            $modalCost += $pesanan->lensa->modal ?? 0;
        }

        // Add aksesoris modal
        if ($pesanan->aksesoris->count() > 0) {
            foreach ($pesanan->aksesoris as $aksesoris) {
                $jumlah = $aksesoris->pivot->jumlah ?? 1;
                $modalCost += ($aksesoris->modal ?? 0) * $jumlah;
            }
        }

        return $modalCost;
    }

    /**
     * Calculate total paid for a pesanan
     */
    private function calculateTotalPaid($pesananId)
    {
        return $this->calculateTotalPaidForPesanan($pesananId);
    }

    private function calculateTotalPaidForPesanan($pesananId)
    {
        return DB::table('rm_pembayarans')
            ->where('pesanan_id', $pesananId)
            ->sum('jumlah');
    }

    public function index(Request $request)
    {
        // Query RmPesanan instead of RmPembayaran
        $query = RmPesanan::with([
            'pemeriksaan.pasien',
            'frame',
            'lensa',
            'aksesoris',
            'pembayarans'
        ]);

        // Filter berdasarkan tanggal dipesan atau pengambilan
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_dipesan', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        // Group by bulan dan tahun untuk summary - compatible dengan SQLite dan MySQL
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            $dateFormat = "strftime('%Y-%m', tanggal_dipesan)";
        } else {
            $dateFormat = "DATE_FORMAT(tanggal_dipesan, '%Y-%m')";
        }

        // Get detailed data paginated
        $data = $query->latest('tanggal_dipesan')->paginate(50)->withQueryString();

        // Enrich data dengan perhitungan
        foreach ($data as $pesanan) {
            $pesanan->modal_cost = $this->calculateModalCost($pesanan);
            $pesanan->harga_jual = $pesanan->biaya_kacamata ?? 0;
            $pesanan->total_bersih = $pesanan->harga_jual - $pesanan->modal_cost;
            $pesanan->total_bayar = $this->calculateTotalPaidForPesanan($pesanan->id);
            $pesanan->sisa_bayar = $pesanan->harga_jual - $pesanan->total_bayar;
        }

        // Calculate summary data by month
        $summaryQuery = RmPesanan::select(
            DB::raw($dateFormat . ' as bulan'),
            DB::raw('COUNT(*) as jumlah_pesanan'),
            DB::raw('SUM(biaya_kacamata) as total_harga_jual')
        )
            ->groupBy(DB::raw($dateFormat))
            ->orderBy(DB::raw($dateFormat), 'desc');

        // Apply same filter for summary
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $summaryQuery->whereBetween('tanggal_dipesan', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $summaryData = $summaryQuery->get();

        // Enrich summary with calculations
        $summary = [];
        foreach ($summaryData as $item) {
            $monthStart = Carbon::createFromFormat('Y-m', $item->bulan)->startOfMonth();
            $monthEnd = Carbon::createFromFormat('Y-m', $item->bulan)->endOfMonth();

            // Get all pesanan for this month
            $monthPesanans = RmPesanan::with(['frame', 'lensa', 'aksesoris', 'pembayarans'])
                ->whereBetween('tanggal_dipesan', [$monthStart, $monthEnd]);

            if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
                $monthPesanans->whereBetween('tanggal_dipesan', [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]);
            }

            $monthPesanans = $monthPesanans->get();

            $item->total_modal = 0;
            $item->total_bersih = 0;
            $item->total_bayar = 0;
            $item->total_sisa = 0;

            foreach ($monthPesanans as $pesanan) {
                $modal = $this->calculateModalCost($pesanan);
                $hargaJual = $pesanan->biaya_kacamata ?? 0;
                $totalBayar = $this->calculateTotalPaidForPesanan($pesanan->id);

                $item->total_modal += $modal;
                $item->total_bersih += ($hargaJual - $modal);
                $item->total_bayar += $totalBayar;
                $item->total_sisa += ($hargaJual - $totalBayar);
            }

            $summary[] = $item;
        }

        $summary = collect($summary);

        // Calculate totals
        $totalHargaJual = $data->sum('harga_jual');
        $totalModalCost = $data->sum('modal_cost');
        $totalBersih = $data->sum('total_bersih');
        $totalBayar = $data->sum('total_bayar');
        $totalSisa = $data->sum('sisa_bayar');

        return view('admin.laporan.rekap_pendapatan_index', compact(
            'data',
            'summary',
            'totalHargaJual',
            'totalModalCost',
            'totalBersih',
            'totalBayar',
            'totalSisa'
        ));
    }

    public function exportExcel(Request $request)
    {
        $query = RmPesanan::with([
            'pemeriksaan.pasien',
            'frame',
            'lensa',
            'aksesoris',
            'pembayarans'
        ]);

        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_dipesan', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $data = $query->latest('tanggal_dipesan')->get();

        // Enrich data dengan perhitungan
        foreach ($data as $pesanan) {
            $pesanan->modal_cost = $this->calculateModalCost($pesanan);
            $pesanan->harga_jual = $pesanan->biaya_kacamata ?? 0;
            $pesanan->total_bersih = $pesanan->harga_jual - $pesanan->modal_cost;
            $pesanan->total_bayar = $this->calculateTotalPaidForPesanan($pesanan->id);
            $pesanan->sisa_bayar = $pesanan->harga_jual - $pesanan->total_bayar;
        }

        // Create Excel using PhpSpreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set title and headers
        $sheet->setCellValue('A1', 'REKAP PENDAPATAN & PEMBAYARAN');
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        $sheet->setCellValue('A2', 'Periode: ' . ($request->tanggal_awal ?? 'Semua') . ' - ' . ($request->tanggal_akhir ?? 'Semua'));
        $sheet->mergeCells('A2:J2');

        // Column headers
        $headers = ['No', 'Tanggal Pesan', 'Nama Pasien', 'Status', 'Harga Jual', 'Modal', 'Bersih', 'Sudah Bayar', 'Sisa Bayar', 'No Pesanan'];
        $sheet->fromArray($headers, null, 'A4');

        // Style headers
        $headerStyle = $sheet->getStyle('A4:J4');
        $headerStyle->getFont()->setBold(true)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFF'));
        $headerStyle->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF0070C0');

        // Add data
        $row = 5;
        $no = 1;
        $totalHargaJual = 0;
        $totalModal = 0;
        $totalBersih = 0;
        $totalBayar = 0;
        $totalSisa = 0;

        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item->tanggal_dipesan->format('d-m-Y'));
            $sheet->setCellValue('C' . $row, $item->pemeriksaan->pasien->nama_pasien ?? '-');
            $sheet->setCellValue('D' . $row, ucfirst($item->status));
            $sheet->setCellValue('E' . $row, $item->harga_jual);
            $sheet->setCellValue('F' . $row, $item->modal_cost);
            $sheet->setCellValue('G' . $row, $item->total_bersih);
            $sheet->setCellValue('H' . $row, $item->total_bayar);
            $sheet->setCellValue('I' . $row, $item->sisa_bayar);
            $sheet->setCellValue('J' . $row, 'PS-' . str_pad($item->id, 5, '0', STR_PAD_LEFT));

            $totalHargaJual += $item->harga_jual;
            $totalModal += $item->modal_cost;
            $totalBersih += $item->total_bersih;
            $totalBayar += $item->total_bayar;
            $totalSisa += $item->sisa_bayar;

            $row++;
            $no++;
        }

        // Add total row
        $sheet->setCellValue('D' . $row, 'TOTAL:');
        $sheet->setCellValue('E' . $row, $totalHargaJual);
        $sheet->setCellValue('F' . $row, $totalModal);
        $sheet->setCellValue('G' . $row, $totalBersih);
        $sheet->setCellValue('H' . $row, $totalBayar);
        $sheet->setCellValue('I' . $row, $totalSisa);

        $sheet->getStyle('D' . $row . ':I' . $row)->getFont()->setBold(true);

        // Auto adjust column width
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(12);
        $sheet->getColumnDimension('E')->setWidth(14);
        $sheet->getColumnDimension('F')->setWidth(14);
        $sheet->getColumnDimension('G')->setWidth(14);
        $sheet->getColumnDimension('H')->setWidth(14);
        $sheet->getColumnDimension('I')->setWidth(14);
        $sheet->getColumnDimension('J')->setWidth(12);

        // Generate file
        $filename = 'Rekap-Pendapatan-' . now()->format('Y-m-d-His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
