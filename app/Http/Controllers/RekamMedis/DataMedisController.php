<?php

namespace App\Http\Controllers\RekamMedis;

use App\Http\Controllers\Controller;
use App\Models\RmPasien;
use App\Models\RmPemeriksaan;
use Illuminate\Http\Request;

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
        $RmPemeriksaan->load(
            'pasien',
            'resep',
            'pesanan.frame',
            'pesanan.lensa',
            'pesanan.pembayarans',
            'pesanan.pengambilan',
            'dokumens'
        );
        return view('admin.rekammedis.datamedis_show', compact('RmPemeriksaan'));
    }

    public function createStep1(Request $request)
    {
        $pasien = null;
        $action = $request->query('action');
        $nama_pasien = $request->query('nama_pasien') ?? '';
        if ($action === 'search') {
            $request->validate([
                'nama_pasien' => 'required|string',
            ]);

            $pasien = RmPasien::where('nama_pasien', 'like', '%' . $request->nama_pasien . '%')->get();
        }

        return view('admin.rekammedis.datamedis_create_step1', compact('action', 'pasien', 'nama_pasien'));
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'no_hp'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:255',
            'alamat'      => 'nullable|string',
            'umur'        => 'nullable|integer|min:0',
            'kategori'    => 'required|in:umum,bpjs,asuransi',
            'no_kartu'    => 'nullable|string|max:50',
            'kelas'       => 'nullable|in:1,2,3',
        ]);

        $pasien = RmPasien::create($validated);

        return redirect()
            ->route('datamedis.create.step2', $pasien->id)
            ->with('success', 'Biodata pasien berhasil disimpan');
    }

    public function createStep2(RmPasien $pasien)
    {
        return view('admin.rekammedis.datamedis_create_step2', compact('pasien'));
    }

    public function storeStep2(Request $request) {}
}
