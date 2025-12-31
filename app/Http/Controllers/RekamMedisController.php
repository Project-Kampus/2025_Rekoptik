<?php

namespace App\Http\Controllers;

use App\Exports\RekapMedisExport;
use App\Models\Frame;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
                $q->whereBetween('tanggal_pemeriksaan', [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]);
            })
            ->latest()
            ->paginate(20)
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
        'no_hp' => 'nullable',
        'kategori' => 'required|in:bpjs,asuransi,umum',
        'no_kartu' => 'nullable|required_if:kategori,bpjs,asuransi',
        'no_sep' => 'nullable|required_if:kategori,bpjs',
        'alamat' => 'nullable',
        
        // Riwayat pasien
        'keluhan_utama' => 'nullable',
        'riwayat_penyakit' => 'nullable',
        'penyakit_sekarang' => 'nullable',
        'penyakit_keluarga' => 'nullable',
        'kebiasaan' => 'nullable',
        'pengobatan' => 'nullable',

        'resep_dari' => 'required',
        'diagnosa' => 'required',
        'tanggal_pemeriksaan' => 'required|date',

        'od_sferis' => 'nullable',
        'od_silindris' => 'nullable',
        'od_axis' => 'nullable',
        'od_add_lensa' => 'nullable',

        'os_sferis' => 'nullable',
        'os_silindris' => 'nullable',
        'os_axis' => 'nullable',
        'os_add_lensa' => 'nullable',

        'frame_id' => 'nullable',
        'lensa' => 'nullable',
        'pd' => 'nullable',

        'biaya_kacamata' => 'nullable|numeric|min:0',
        'dibayar_bpjs' => 'nullable|numeric|min:0',
        'dibayar_asuransi' => 'nullable|numeric|min:0',
        'dibayar_pasien' => 'nullable|numeric|min:0',

        'tanggal_dipesan' => 'nullable|date',
        'tanggal_pengambilan' => 'nullable|date',
    ]);

    // NORMALISASI PEMBAYARAN
    $data['dibayar_bpjs'] = $data['dibayar_bpjs'] ?? 0;
    $data['dibayar_asuransi'] = $data['dibayar_asuransi'] ?? 0;
    $data['dibayar_pasien'] = $data['dibayar_pasien'] ?? 0;

    if ($data['kategori'] === 'bpjs') {
        $data['dibayar_asuransi'] = 0;
    }
    if ($data['kategori'] === 'asuransi') {
        $data['dibayar_bpjs'] = 0;
        $data['no_sep'] = null;
    }
    if ($data['kategori'] === 'umum') {
        $data['dibayar_bpjs'] = 0;
        $data['dibayar_asuransi'] = 0;
        $data['no_kartu'] = null;
        $data['no_sep'] = null;
    }

    $pasien = Pasien::create($data);
    $pasien->update(['sisa' => $pasien->hitungSisa()]);

    return redirect()->route('rekam-medis.index')
        ->with('success', 'Rekam medis berhasil disimpan');
}



    public function edit(Pasien $pasien)
    {
        $frames = Frame::aktif()->get();
        return view('admin.rekamMedis_edit', compact('pasien', 'frames'));
    }

    public function update(Request $request, Pasien $pasien)
{
    $data = $request->validate([
        'nama_pasien' => 'required|string',
        'kategori' => 'required|in:bpjs,asuransi,umum',

        'no_kartu' => 'nullable|required_if:kategori,bpjs,asuransi',
        'no_sep'   => 'nullable|required_if:kategori,bpjs',

        'no_hp' => 'nullable',
        'alamat' => 'nullable',

        // Riwayat pasien
        'keluhan_utama' => 'nullable',
        'riwayat_penyakit' => 'nullable',
        'penyakit_sekarang' => 'nullable',
        'penyakit_keluarga' => 'nullable',
        'kebiasaan' => 'nullable',
        'pengobatan' => 'nullable',

        'resep_dari' => 'required|string',
        'tanggal_pemeriksaan' => 'required|date',
        'diagnosa' => 'required|string',

        'frame_id' => 'nullable|exists:frames,id',
        'lensa' => 'nullable',
        'pd' => 'nullable',

        'biaya_kacamata' => 'required|numeric|min:0',
        'dibayar_bpjs' => 'nullable|numeric|min:0',
        'dibayar_asuransi' => 'nullable|numeric|min:0',
        'dibayar_pasien' => 'nullable|numeric|min:0',

        'tanggal_dipesan' => 'nullable|date',
        'tanggal_pengambilan' => 'nullable|date',
    ]);

    // NORMALISASI PEMBAYARAN
    $data['dibayar_bpjs'] = $data['dibayar_bpjs'] ?? 0;
    $data['dibayar_asuransi'] = $data['dibayar_asuransi'] ?? 0;
    $data['dibayar_pasien'] = $data['dibayar_pasien'] ?? 0;

    if ($data['kategori'] === 'bpjs') {
        $data['dibayar_asuransi'] = 0;
    }
    if ($data['kategori'] === 'asuransi') {
        $data['dibayar_bpjs'] = 0;
        $data['no_sep'] = null;
    }
    if ($data['kategori'] === 'umum') {
        $data['dibayar_bpjs'] = 0;
        $data['dibayar_asuransi'] = 0;
        $data['no_kartu'] = null;
        $data['no_sep'] = null;
    }

    // VALIDASI TOTAL BAYAR
    $totalBayar = $data['dibayar_bpjs'] + $data['dibayar_asuransi'] + $data['dibayar_pasien'];
    if ($totalBayar > $data['biaya_kacamata']) {
        return back()
            ->withErrors(['dibayar_pasien' => 'Total pembayaran melebihi biaya kacamata'])
            ->withInput();
    }

    // KELOLA STOK FRAME
    if ($pasien->frame_id != $request->frame_id) {
        if ($pasien->frame_id) Frame::where('id', $pasien->frame_id)->increment('stok');
        if ($request->frame_id) Frame::where('id', $request->frame_id)->decrement('stok');
    }

    $pasien->update($data);
    $pasien->update(['sisa' => $pasien->hitungSisa()]);

    return redirect()->route('rekam-medis.index')
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

    public function rekap(Request $request)
    {
        $query = Pasien::with('frame');

        // SEARCH
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_pasien', 'like', '%' . $request->q . '%')
                    ->orWhere('no_kartu', 'like', '%' . $request->q . '%');
            });
        }

        // FILTER KATEGORI
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // FILTER TANGGAL
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_pemeriksaan', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $pasiens = $query
            ->latest('tanggal_pemeriksaan')
            ->paginate(10)
            ->withQueryString();

        return view('admin.rekamMedis_rekap', compact('pasiens'));
    }
    public function rekapExcel(Request $request)
    {
        $fileName = 'rekap-medis-' . now()->format('d-m-Y') . '.xlsx';

        return Excel::download(
            new RekapMedisExport($request),
            $fileName
        );
    }
    public function rekapPdf() {}

    public function show(Pasien $pasien)
{
    return view('admin.rekamMedis_show', compact('pasien'));
}

}
