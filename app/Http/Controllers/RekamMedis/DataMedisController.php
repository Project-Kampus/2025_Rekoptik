<?php

namespace App\Http\Controllers\RekamMedis;

use App\Http\Controllers\Controller;
use App\Models\Aksesoris;
use App\Models\Document;
use App\Models\Frame;
use App\Models\Lensa;
use App\Models\RmDokument;
use App\Models\RmPasien;
use App\Models\RmPembayaran;
use App\Models\RmPemeriksaan;
use App\Models\RmPesanan;
use App\Models\RmResep;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'dokumens.dokumen'
        );
        $uploadedDokumens = $RmPemeriksaan->dokumens->keyBy('dokumens_id');
        $allDokumens = Document::all();

        return view('admin.rekammedis.datamedis_show', compact('RmPemeriksaan', 'uploadedDokumens', 'allDokumens'));
    }

    public function storeDokumnet(Request $request, RmPemeriksaan $RmPemeriksaan)
    {
        $validated = $request->validate([
            'dokumen_id' => 'required|exists:dokumens,id',
            'file'       => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $dokumenFile = $request->file('file')->store('dokumen_pendukung', 'public');
        RmDokument::create([
            'dokumens_id'    => $validated['dokumen_id'],
            'pemeriksaan_id' => $RmPemeriksaan->id,
            'url'      => $dokumenFile,
        ]);
        return redirect()
            ->route('datamedis.show', [$RmPemeriksaan])
            ->with('success', 'Dokumen pendukung berhasil diunggah');
    }

    public function storePembayaran(Request $request, RmPemeriksaan $RmPemeriksaan)
    {
        $validated = $request->validate([
            'tanggal_bayar' => ['required', 'date'],
            'metode' => [
                'required',
                Rule::in([
                    'bpjs',
                    'asuransi',
                    'tunai',
                    'non-tunai',
                ]),
            ],
            'jumlah' => ['required', 'numeric', 'min:0'],
        ]);

        RmPembayaran::create([
            'pesanan_id' => $RmPemeriksaan->pesanan->id,
            'metode' => $validated['metode'],
            'jumlah' => $validated['jumlah'],
            'tanggal_bayar' => $validated['tanggal_bayar'],
        ]);
        return redirect()
            ->route('datamedis.show', [$RmPemeriksaan])
            ->with('success', 'Pembayaran berhasil dicatat');
    }

    public function destroyPembayaran(RmPembayaran $RmPembayaran)
    {
        $RmPembayaran->delete();
        return redirect()
            ->route('datamedis.show', [$RmPembayaran->pesanan->pemeriksaan])
            ->with('success', 'Pembayaran berhasil dihapus');
    }

    public function cetatakStruk(RmPembayaran $RmPembayaran)
    {
        $RmPemeriksaan = $RmPembayaran->pesanan->pemeriksaan;
        return view('pdf.strukPembayaran', compact('RmPemeriksaan', 'RmPembayaran')); // for debug
        $pdf = Pdf::loadView('pdf.strukPembayaran', compact('RmPemeriksaan', 'RmPembayaran'));
        return $pdf->download('Struk-' . str_pad($RmPembayaran->id, 6, '0', STR_PAD_LEFT) . '.pdf');
    }

    public function cetakSuratBalasan(RmPemeriksaan $RmPemeriksaan)
    {
        return view('pdf.suratBalasan', compact('RmPemeriksaan')); // for debug
        $pdf = Pdf::loadView('pdf.suratBalasan', compact('RmPemeriksaan'));
        return $pdf->download('SuratBalasan-' . str_pad($RmPemeriksaan->id, 6, '0', STR_PAD_LEFT) . '.pdf');
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
        $frame = Frame::all();
        $lensa = Lensa::all();
        $aksesoris = Aksesoris::all();
        return view('admin.rekammedis.datamedis_create_step2', compact('pasien', 'frame', 'lensa', 'aksesoris'));
    }

    public function storeStep2(Request $request, RmPasien $pasien)
    {
        // return $request->all();
        $validated = $request->validate([
            'no_sep' => 'required|string',
            'diagnosa' => 'required|string',

            'keluhan_utama' => 'required|string',
            'riwayat_penyakit' => 'required|string',
            'penyakit_sekarang' => 'required|string',
            'penyakit_keluarga' => 'required|string',
            'kebiasaan' => 'required|string',
            'pengobatan' => 'required|string',

            'resep_dari' => 'required|string',
            'resep_tanggal' => 'required|date',

            'resep.kanan.sph' => 'numeric|required',
            'resep.kanan.cyl' => 'numeric|required',
            'resep.kanan.axis' => 'numeric|required',
            'resep.kanan.add' => 'numeric|required',
            'resep.kanan.pd' => 'numeric|required',

            'resep.kiri.sph' => 'numeric|required',
            'resep.kiri.cyl' => 'numeric|required',
            'resep.kiri.axis' => 'numeric|required',
            'resep.kiri.add' => 'numeric|required',
            'resep.kiri.pd' => 'numeric|required',

            'frame_id' => 'required|exists:frames,id',
            'lensa_id' => 'required|exists:lensas,id',
            'aksesoris_id' => 'required|exists:aksesoris,id',
            'biaya_kacamata' => 'required|numeric',
            'tanggal_dipesan' => 'required|date',
            'tanggal_pengambilan' => 'required|date',
        ]);

        $RmPemeriksaan = RmPemeriksaan::create([
            'pasien_id' => $pasien->id,
            'user_id' => auth()->id(),
            'no_sep' => $validated['no_sep'],

            'keluhan_utama' => $validated['keluhan_utama'],
            'riwayat_penyakit' => $validated['riwayat_penyakit'],
            'penyakit_sekarang' => $validated['penyakit_sekarang'],
            'penyakit_keluarga' => $validated['penyakit_keluarga'],
            'kebiasaan' => $validated['kebiasaan'],
            'pengobatan' => $validated['pengobatan'],
            'diagnosa' => $validated['diagnosa']
        ]);

        $RMresep = RmResep::create([
            'pemeriksaan_id' => $RmPemeriksaan->id,
            'resep_dari' => $validated['resep_dari'],
            'tanggal' => $validated['resep_tanggal'],

            'od_sferis' => $validated['resep']['kanan']['sph'],
            'od_silindris' => $validated['resep']['kanan']['cyl'],
            'od_axis' => $validated['resep']['kanan']['axis'],
            'od_add_lensa' => $validated['resep']['kanan']['add'],
            'pd_od' => $validated['resep']['kanan']['pd'],

            'os_sferis' => $validated['resep']['kiri']['sph'],
            'os_silindris' => $validated['resep']['kiri']['cyl'],
            'os_axis' => $validated['resep']['kiri']['axis'],
            'os_add_lensa' => $validated['resep']['kiri']['add'],
            'pd_os' => $validated['resep']['kiri']['pd'],
        ]);

        RmPesanan::create([
            'pemeriksaan_id' => $RmPemeriksaan->id,
            'resep_id' => $RMresep->id,
            'frame_id' => $validated['frame_id'],
            'lensa_id' => $validated['lensa_id'],
            'aksesoris_id' => $validated['aksesoris_id'],
            'biaya_kacamata' => $validated['biaya_kacamata'],
            'tanggal_dipesan' => $validated['tanggal_dipesan'],
            'tanggal_pengambilan' => $validated['tanggal_pengambilan'],
        ]);

        return redirect()
            ->route('datamedis.show', [$RmPemeriksaan])
            ->with('success', 'Data medis berhasil disimpan');
    }
}
