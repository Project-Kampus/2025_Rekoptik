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
        $frames = Frame::orderBy('merk')->get();
        $lensas = Lensa::orderBy('nama_lensa')->get();

        return view('admin.rekamMedis_create', compact('frames', 'lensas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // Data Pasien
            'nama_pasien' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'kategori' => 'required|in:bpjs,asuransi,umum',
            'no_kartu' => 'nullable|required_if:kategori,bpjs,asuransi',
            'no_sep' => 'nullable|required_if:kategori,bpjs',
            'alamat' => 'nullable|string',

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
            'dokument' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

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


        if ($request->hasFile('dokument')) {
            $data['dokumen'] = $request->file('dokument')
                ->store('dokumen_pasien', 'public');
        }

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




        $pasien = Pasien::create($data);
        $pasien->update(['sisa' => $pasien->hitungSisa()]);

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
