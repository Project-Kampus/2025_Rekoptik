<?php

namespace App\Http\Controllers;

use App\Models\Frame;
use App\Models\Pasien;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $pasiens = Pasien::with('frame')
            ->when($request->q, function ($q) use ($request) {
                $q->where(function ($qq) use ($request) {
                    $qq->where('nama_pasien', 'like', "%{$request->q}%")
                        ->orWhere('no_kartu', 'like', "%{$request->q}%");
                });
            })
            ->when($request->kategori, function ($q) use ($request) {
                $q->where('kategori', strtoupper($request->kategori));
            })
            ->when($request->tanggal_awal && $request->tanggal_akhir, function ($q) use ($request) {
                $q->whereBetween('created_at', [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.rekamMedis_index', compact('pasiens'));
    }

    public function create()
    {
        $frames = Frame::aktif()->where('stok', '>', 0)->get();
        return view('admin.rekamMedis_create', compact('frames'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pasien' => 'required',
            'resep_dari' => 'nullable',
            'no_kartu' => 'required',
            'no_hp' => 'nullable',
            'alamat' => 'nullable',
            'kategori' => 'required',
            'tanggal_pemeriksaan' => 'required|date',

            // Resep
            'od_sferis' => 'nullable|numeric',
            'od_silindris' => 'nullable|numeric',
            'od_axis' => 'nullable|numeric',
            'os_sferis' => 'nullable|numeric',
            'os_silindris' => 'nullable|numeric',
            'os_axis' => 'nullable|numeric',

            'lensa' => 'nullable',
            'pd' => 'nullable|string',
            'frame_id' => 'nullable|exists:frames,id',

            'biaya_kacamata' => 'nullable|numeric',
            'dibayar_bpjs' => 'nullable|numeric',
            'dibayar_pasien' => 'nullable|numeric',
            'tanggal_pengambilan' => 'nullable|date',
        ]);

        $pasien = Pasien::create($data);

        // Hitung sisa
        $pasien->update([
            'sisa' => $pasien->hitungSisa()
        ]);

        // Kurangi stok frame
        if ($pasien->frame_id) {
            Frame::where('id', $pasien->frame_id)->decrement('stok');
        }

        return redirect()
            ->route('rekam-medis.index')
            ->with('success', 'Rekam medis berhasil ditambahkan');
    }

    public function edit(Pasien $pasien)
    {
        $frames = Frame::aktif()->get();
        return view('admin.rekamMedis_edit', compact('pasien', 'frames'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $data = $request->validate([
            'nama_pasien' => 'required',
            'resep_dari' => 'nullable',
            'no_kartu' => 'required',
            'no_hp' => 'nullable',
            'alamat' => 'nullable',
            'kategori' => 'required',
            'tanggal_pemeriksaan' => 'required|date',

            // Resep
            'od_sferis' => 'nullable|numeric',
            'od_silindris' => 'nullable|numeric',
            'od_axis' => 'nullable|numeric',
            'os_sferis' => 'nullable|numeric',
            'os_silindris' => 'nullable|numeric',
            'os_axis' => 'nullable|numeric',

            'lensa' => 'nullable',
            'pd' => 'nullable|string',
            'frame_id' => 'nullable|exists:frames,id',

            'biaya_kacamata' => 'nullable|numeric',
            'dibayar_bpjs' => 'nullable|numeric',
            'dibayar_pasien' => 'nullable|numeric',
            'tanggal_pengambilan' => 'nullable|date',
        ]);

        // Jika frame diganti
        if ($pasien->frame_id && $pasien->frame_id != $request->frame_id) {
            // Kembalikan stok frame lama
            Frame::where('id', $pasien->frame_id)->increment('stok');

            // Kurangi stok frame baru
            if ($request->frame_id) {
                Frame::where('id', $request->frame_id)->decrement('stok');
            }
        }

        $pasien->update($data);

        $pasien->update([
            'sisa' => $pasien->hitungSisa()
        ]);

        return redirect()
            ->route('rekam-medis.index')
            ->with('success', 'Rekam medis berhasil diperbarui');
    }

    public function destroy(Pasien $pasien)
    {
        // Kembalikan stok frame
        if ($pasien->frame_id) {
            Frame::where('id', $pasien->frame_id)->increment('stok');
        }

        $pasien->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    public function struk(Pasien $pasien)
    {
        return view('admin.rekamMedis_struk', compact('pasien'));
    }
}
