<?php

namespace App\Http\Controllers\RekamMedis;

use App\Http\Controllers\Controller;
use App\Models\RmPemeriksaan;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class DataMedisController extends Controller
{
    public function index(Request $request)
    {
        $data = RmPemeriksaan::with('pasien', 'pesanan', 'resep')->get();
        // return $data;
        return view('admin.rekammedis.datamedis_index', compact('data'));
    }

    public function show(RmPemeriksaan $RmPemeriksaan)
    {
        $RmPemeriksaan->load('pasien', 'resep', 'pesanan.frame', 'pesanan.lensa', 'pesanan.pembayarans', 'pesanan.pengambilan', 'dokumens');
        return view('admin.rekammedis.datamedis_show', compact('RmPemeriksaan'));
    }
}
