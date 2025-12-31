<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatFrameController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('pasiens')
            ->leftJoin('frames', 'pasiens.frame_id', '=', 'frames.id')
            ->leftJoin('lensas', 'pasiens.lensa_id', '=', 'lensas.id')
            ->select(
                'pasiens.tanggal_pengambilan as tanggal',
                'pasiens.nama_pasien',
                'frames.kode_frame',
                'frames.merk as merk_frame',
                'lensas.nama_lensa',
                'lensas.kategori',
                'pasiens.od_sferis',
                'pasiens.od_silindris',
                'pasiens.od_axis',
                'pasiens.os_sferis',
                'pasiens.os_silindris',
                'pasiens.os_axis'
            );

        // FILTER TANGGAL
        if ($request->filled('from')) {
            $query->whereDate('pasiens.tanggal_pengambilan', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('pasiens.tanggal_pengambilan', '<=', $request->to);
        }

        $riwayat = $query
            ->orderBy('pasiens.tanggal_pengambilan', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.riwayat_frame', compact('riwayat'));
    }
}
