<?php

namespace App\Http\Controllers;

use App\Exports\RekapMedisExport;
use App\Models\Frame;
use App\Models\lensa;
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

    return view('admin.rekamMedis_index', compact('pasiens'));
}


    public function create()
    {
        $frames = Frame::orderBy('merk')->get();
        $lensas = Lensa::orderBy('nama_lensa')->get();

        return view('admin.rekamMedis_create', compact('frames', 'lensas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // pasien
            'nama_pasien' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'kategori' => 'required|in:bpjs,asuransi,umum',
            'no_kartu' => 'nullable|required_if:kategori,bpjs,asuransi',
            'alamat' => 'nullable|string',
            'umur' => 'nullable|integer|min:0',

            // pemeriksaan
            'resep_dari' => 'required|string|max:255',
            'diagnosa' => 'required|string|max:255',
            'no_sep' => 'nullable|required_if:kategori,bpjs',
            'tanggal_pemeriksaan' => 'required|date',

            // riwayat
            'keluhan_utama' => 'nullable|string',
            'riwayat_penyakit' => 'nullable|string',
            'penyakit_sekarang' => 'nullable|string',
            'penyakit_keluarga' => 'nullable|string',
            'kebiasaan' => 'nullable|string',
            'pengobatan' => 'nullable|string',

            // dokumen
            'doc_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'doc_legalitas' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'doc_rujukan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // resep mata
            'od_sferis' => 'nullable|string',
            'od_silindris' => 'nullable|string',
            'od_axis' => 'nullable|string',
            'od_add_lensa' => 'nullable|string',
            'os_sferis' => 'nullable|string',
            'os_silindris' => 'nullable|string',
            'os_axis' => 'nullable|string',
            'os_add_lensa' => 'nullable|string',

            // kacamata
            'frame_id' => 'nullable|exists:frames,id',
            'lensa_id' => 'nullable|exists:lensas,id',
            'pd' => 'nullable|string',

            // biaya
            'biaya_kacamata' => 'nullable|numeric',
            'dibayar_bpjs' => 'nullable|numeric',
            'dibayar_asuransi' => 'nullable|numeric',
            'dibayar_pasien' => 'nullable|numeric',
            'tanggal_dipesan' => 'nullable|date',
        ]);



        foreach (['doc_ktp', 'doc_legalitas', 'doc_rujukan'] as $doc) {
            if ($request->hasFile($doc)) {
                $validated[$doc] = $request->file($doc)
                    ->store("rekam-medis/{$doc}", 'public');
            }
        }

        $validated['dibayar_bpjs'] = $validated['dibayar_bpjs'] ?? 0;
        $validated['dibayar_asuransi'] = $validated['dibayar_asuransi'] ?? 0;
        $validated['dibayar_pasien'] = $validated['dibayar_pasien'] ?? 0;

        switch ($validated['kategori']) {
            case 'bpjs':
                $validated['dibayar_asuransi'] = 0;
                break;

            case 'asuransi':
                $validated['dibayar_bpjs'] = 0;
                $validated['no_sep'] = null;
                break;

            case 'umum':
                $validated['dibayar_bpjs'] = 0;
                $validated['dibayar_asuransi'] = 0;
                $validated['no_kartu'] = null;
                $validated['no_sep'] = null;
                break;
        }

        $pasien = Pasien::create($validated);
        $pasien->update([
            'sisa' => $pasien->hitungSisa()
        ]);

        return redirect()->route('rekam-medis.index')
            ->with('success', 'Rekam medis berhasil disimpan');
    }

    public function edit(Pasien $pasien)
    {
        $frames = Frame::all();
        $lensas = lensa::all();
        return view('admin.rekamMedis_edit', compact('pasien', 'frames', 'lensas'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $data = $request->validate([
            // Data Pasien
            'nama_pasien' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'kategori' => 'required|in:bpjs,asuransi,umum',
            'no_kartu' => 'nullable|required_if:kategori,bpjs,asuransi',
            'no_sep' => 'nullable|required_if:kategori,bpjs',
            'alamat' => 'nullable|string',
            'umur' => 'nullable|integer|min:0',

            // Riwayat Pasien
            'keluhan_utama' => 'nullable|string',
            'riwayat_penyakit' => 'nullable|string',
            'penyakit_sekarang' => 'nullable|string',
            'penyakit_keluarga' => 'nullable|string',
            'kebiasaan' => 'nullable|string',
            'pengobatan' => 'nullable|string',

            // Pemeriksaan
            'resep_dari' => 'required|string',
            'diagnosa' => 'required|string',
            'tanggal_pemeriksaan' => 'required|date',

            // Resep Mata
            'od_sferis' => 'nullable|numeric',
            'od_silindris' => 'nullable|numeric',
            'od_axis' => 'nullable|numeric',
            'od_add_lensa' => 'nullable|numeric',

            'os_sferis' => 'nullable|numeric',
            'os_silindris' => 'nullable|numeric',
            'os_axis' => 'nullable|numeric',
            'os_add_lensa' => 'nullable|numeric',

            // Kacamata
            'frame_id' => 'nullable|exists:frames,id',
            'lensa_id' => 'nullable|exists:lensas,id',
            'pd' => 'nullable|numeric|min:0',

            // Biaya
            'biaya_kacamata' => 'nullable|numeric|min:0',
            'dibayar_bpjs' => 'nullable|numeric|min:0',
            'dibayar_asuransi' => 'nullable|numeric|min:0',
            'dibayar_pasien' => 'nullable|numeric|min:0',

            // Tanggal
            'tanggal_dipesan' => 'nullable|date',
            'tanggal_pengambilan' => 'nullable|date|after_or_equal:tanggal_dipesan',
        ]);

        // NORMALISASI PEMBAYARAN
        $data['dibayar_bpjs'] = $data['dibayar_bpjs'] ?? 0;
        $data['dibayar_asuransi'] = $data['dibayar_asuransi'] ?? 0;
        $data['dibayar_pasien'] = $data['dibayar_pasien'] ?? 0;

        switch ($data['kategori']) {
            case 'bpjs':
                $data['dibayar_asuransi'] = 0;
                break;

            case 'asuransi':
                $data['dibayar_bpjs'] = 0;
                $data['no_sep'] = null;
                break;

            case 'umum':
                $data['dibayar_bpjs'] = 0;
                $data['dibayar_asuransi'] = 0;
                $data['no_kartu'] = null;
                $data['no_sep'] = null;
                break;
        }

        // VALIDASI TOTAL BAYAR
        $totalBayar = $data['dibayar_bpjs'] + $data['dibayar_asuransi'] + $data['dibayar_pasien'];
        if ($totalBayar > $data['biaya_kacamata']) {
            return back()
                ->withErrors(['dibayar_pasien' => 'Total pembayaran melebihi biaya kacamata'])
                ->withInput();
        }

        $pasien->update($data);
        $pasien->update(['sisa' => $pasien->hitungSisa()]);

        return redirect()->route('rekam-medis.index')
            ->with('success', 'Rekam medis berhasil diperbarui');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    public function struk(Pasien $pasien)
    {
        return view('admin.rekamMedis_struk', compact('pasien'));
    }
    public function surat(Pasien $pasien)
    {
        return view('admin.rekamMedis_suratBalasan', compact('pasien'));
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

    public function show(Pasien $pasien)
    {
        return view('admin.rekamMedis_show', compact('pasien'));
    }

    public function pengambilan(Request $request, Pasien $pasien)
{
    $data = $request->validate([
        'tanggal_pengambilan' => 'required|date',
        'nama_pengambil' => 'required|string|max:255',
        'hub_pengambil' => 'required|string|max:100',
        'bukti_pengambil' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $data['bukti_pengambil'] = $request->file('bukti_pengambil')
        ->store('rekam-medis/pengambilan', 'public');

    // 🔥 INI YANG KURANG
    $data['status'] = 'diambil';

    $pasien->update($data);

    return redirect()
        ->route('rekam-medis.show', $pasien->id)
        ->with('success', 'Pengambilan berhasil disimpan');
}

}
