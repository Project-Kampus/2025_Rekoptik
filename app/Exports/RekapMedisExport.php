<?php

namespace App\Exports;

use App\Models\Pasien;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class RekapMedisExport implements FromView, WithEvents
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $pasiens = Pasien::where('kategori', 'bpjs')
    ->orderBy('tanggal_pengambilan')
    ->get();


        return view('export.rekapMedis_excel', compact('pasiens'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();

                /** ===============================
                 *  MERGE JUDUL
                 * =============================== */
                $sheet->mergeCells('A1:M1');
                $sheet->mergeCells('A2:M2');

                /** ===============================
                 *  MERGE HEADER
                 * =============================== */
                $sheet->mergeCells('A4:A5');
                $sheet->mergeCells('B4:B5');
                $sheet->mergeCells('C4:C5');
                $sheet->mergeCells('D4:D5');

                $sheet->mergeCells('E4:F4');
                $sheet->mergeCells('G4:H4');
                $sheet->mergeCells('I4:J4');

                $sheet->mergeCells('K4:K5');
                $sheet->mergeCells('L4:L5');
                $sheet->mergeCells('M4:M5');

                /** ===============================
                 *  FONT & ALIGN
                 * =============================== */
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(13);

                $sheet->getStyle("A4:M5")->getFont()->setBold(true);
                $sheet->getStyle("A4:M5")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("A4:M{$lastRow}")->getAlignment()->setVertical('center');

                /** ===============================
                 *  BORDER
                 * =============================== */
                $sheet->getStyle("A4:M{$lastRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                /** ===============================
                 *  FORMAT RUPIAH
                 * =============================== */
                $sheet->getStyle("K6:M{$lastRow}")
                    ->getNumberFormat()
                    ->setFormatCode('"Rp" #,##0');


                    // FORMAT TANGGAL (TANPA JAM)
$sheet->getStyle("B6:B{$lastRow}")
    ->getNumberFormat()
    ->setFormatCode('dd-mm-yyyy');

$sheet->getStyle("F6:F{$lastRow}")
    ->getNumberFormat()
    ->setFormatCode('dd-mm-yyyy');


                /** ===============================a
                 *  COLUMN WIDTH
                 * =============================== */
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(18);
                $sheet->getColumnDimension('C')->setWidth(8);
                $sheet->getColumnDimension('D')->setWidth(18);
                $sheet->getColumnDimension('E')->setWidth(20);
                $sheet->getColumnDimension('F')->setWidth(15);
                $sheet->getColumnDimension('G')->setWidth(12);
                $sheet->getColumnDimension('H')->setWidth(12);
                $sheet->getColumnDimension('I')->setWidth(10);
                $sheet->getColumnDimension('J')->setWidth(10);
                $sheet->getColumnDimension('K')->setWidth(18);
                $sheet->getColumnDimension('L')->setWidth(18);
                $sheet->getColumnDimension('M')->setWidth(18);

                /** ===============================
                 *  PAGE SETUP
                 * =============================== */
                $sheet->getPageSetup()
                    ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE)
                    ->setPaperSize(PageSetup::PAPERSIZE_A4);

                $sheet->getPageSetup()->setRowsToRepeatAtTop([4, 5]);
            }
        ];
    }
}
