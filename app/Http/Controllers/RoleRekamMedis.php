<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class RoleRekamMedis extends Controller
{
    public function index() {}

    public function rekapMedisBpjs(Request $request)
    {
        $rekamMedis = Pasien::with('frame')
            ->when($request->q, function ($q) use ($request) {
                $q->where(function ($qq) use ($request) {
                    $qq->where('nama_pasien', 'like', "%{$request->q}%")
                        ->orWhere('no_kartu', 'like', "%{$request->q}%");
                });
            })
            ->when($request->kategori, function ($q) use ($request) {
                $q->where('kategori', $request->kategori);
            })
            ->when($request->tanggal_awal && $request->tanggal_akhir, function ($q) use ($request) {
                $q->whereBetween('tanggal_pemeriksaan', [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]);
            })
            ->latest('tanggal_pemeriksaan')
            ->paginate(20)
            ->withQueryString();
        return view('RoleLuar.rekapMedis_bpjs', compact('rekamMedis'));
    }

    public function rekapMedisDimkes() {}
}
